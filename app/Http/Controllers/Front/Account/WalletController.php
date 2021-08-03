<?php

namespace App\Http\Controllers\Front\Account;

use App\Enums\TransactionTypes;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Transaction;
use App\Services\Payment\Fcp;
use DB;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Log;
use Throwable;

class WalletController extends Controller
{
    public function show()
    {
        return view('pages.front.account.wallet', [
            'tab' => 'wallet'
        ]);
    }

    public function invoiceFcp(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'integer', 'min:100', 'max:1000000'],
        ]);

        $amount = intval($request->input('amount')) * 10;

        $invoice = new Invoice();
        $invoice->user_id = auth()->id();
        $invoice->amount = $amount;
        $invoice->gateway = 'fcp';
        $invoice->meta = json_encode([
            'ip' => $request->ip(),
            'agent' => $request->userAgent(),
        ]);
        $invoice->save();

        return view('pages.front.account.wallet_invoice_fcp', [
            'tab' => 'wallet',
            'gatewayUrl' => config('payment.gateways.fcp.url'),
            'amount' => $amount,
            'resNum' => $invoice->id,
            'mid' => config('payment.gateways.fcp.merchantId'),
            'redirectURL' => config('payment.gateways.fcp.merchantId'),
        ]);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function callbackFcp(Request $request)
    {
        $request->validate([
            'State' => ['required'],
            'ResNum' => ['required'],
            'RefNum' => ['required'],
        ]);

        try {
            if ($request->input('State') != 'OK') {
                throw new Exception($request->all());
            }

            $fcp = new Fcp();
            $fcp->verify($request->input('RefNum'));
            Log::info('Payment transaction verified:', $request->all());

            /** @var Invoice $invoice */
            $invoice = Invoice::with('user')->find($request->input('ResNum'));

            if ($invoice == null) {
                throw new Exception();
            }

            DB::transaction(function () use ($request, $invoice) {
                /** @var Transaction $last */
                $last = Transaction::whereUserId($invoice->user_id)
                    ->orderByDesc('id')
                    ->lockForUpdate()
                    ->first();

                $balance = $last ? $last->balance : 0;

                $transaction = new Transaction();
                $transaction->user_id = $invoice->user_id;
                $transaction->transactionable_type = Invoice::class;
                $transaction->transactionable_id = $invoice->id;
                $transaction->reference_id = $request->input('RefNum');
                $transaction->card_number = $request->input('CardMaskPan');
                $transaction->type = TransactionTypes::CREDIT_INCREASE;
                $transaction->amount = $invoice->amount;
                $transaction->balance = $balance + $invoice->amount;
                $transaction->meta = json_encode([
                    'ip' => $request->ip(),
                    'agent' => $request->userAgent(),
                ]);
                $transaction->save();

                $invoice->user->balance = $transaction->balance;
                $invoice->user->save();
            });

            return redirect()->route('account.wallet')->with('success', trans('words.credit_done'));
        } catch (Throwable $e) {
            Log::warning($e);
            return redirect()->route('account.wallet')->with('error', trans('words.credit_failed'));
        }
    }
}
