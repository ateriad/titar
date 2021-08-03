<?php


namespace App\Http\Controllers\Admin;


use App\Enums\TransactionTypes;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'nullable|exists:users,id',
            'from' => 'nullable|numeric',
            'to' => 'nullable|numeric',
            'ref_id' => 'nullable|string',
            'gateway' => 'nullable|string',
            'status' => 'nullable',
        ]);

        if ($request->input('from')) {
            $from = Carbon::createFromTimestampMs($request->input('from'));
        } else {
            $from = Carbon::createFromTimestampMs(1577836800000);
        }
        $to = Carbon::createFromTimestampMs($request->input('to') ?: (time() . '000'));

        if ($to->getTimestamp() < $from->getTimestamp()) {
            return back()->with('error', 'Time range error.');
        }

        $userId = $request->input('user_id', null);

        $refId = $request->input('ref_id', null);

        $gateway = $request->input('gateway', null);

        $status = $request->input('status', null);

        if ($refId) {
            $transaction = Transaction::where('reference_id', '=', $refId)->first();
            if ($transaction) {
                $invoices = Invoice::with('transaction')
                    ->where('id', '=', $transaction->transactionable_id)
                    ->paginate(50);
            } else {
                return back()->with('error', trans('validation.wrong_reference_id'));
            }
        } else {
            $invoiceIds = Transaction::pluck('transactionable_id')
                ->toArray();
            $invoices = Invoice::with('transaction')
                ->where(function (Builder $q) use ($userId) {
                    if ($userId) {
                        $q->where('user_id', '=', $userId);
                    }
                })
                ->where(function (Builder $q) use ($gateway) {
                    if ($gateway) {
                        $q->where('gateway', '=', $gateway);
                    }
                })
                ->where(function (Builder $q) use ($invoiceIds, $status) {
                    if ($status == 2) {
                        $q->whereIn('id', $invoiceIds);
                    } elseif ($status == 1) {
                        $q->whereNotIn('id', $invoiceIds);
                    }
                })
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->orderByDesc('id')
                ->paginate(50);
        }
        return view('pages.admin.payments.index', [
            'invoices' => $invoices,
            'from' => $from,
            'to' => $to,
            'userId' => $userId,
            'gateway' => $gateway,
            'refId' => $refId,
            'status' => $status,
        ]);
    }
}
