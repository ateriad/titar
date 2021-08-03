<?php

namespace App\Http\Controllers\Front\Account;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class SubscriptionsController extends Controller
{
    public function show()
    {
        return view('pages.front.account.subscriptions', [
            'tab' => 'subscription',
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function purchase(Request $request)
    {
        $request->validate([
            'plan' => ['required', 'in:0,1,2'],
        ]);

        $plan = $request->input('plan');
        $price = config("subscriptions.plans.$plan.price");

        if (auth()->user()->balance < $price) {
            return back()->with('error', trans('words.insufficient-balance'));
        }

        $previous = Subscription::whereUserId(auth()->id())->orderByDesc('id')->first();
        $start = $previous ? $previous->end->copy()->addDay() : now();
        $end = $start->copy()->addMonths(config("subscriptions.plans.$plan.month"));

        DB::transaction(function () use ($price, $start, $end) {
            /** @var User $user */
            $user = User::where('id', auth()->id())
                ->lockForUpdate()
                ->first();

            if ($user->balance >= $price) {
                $user->balance = $user->balance - $price;
                $user->save();

                $subscription = new Subscription();
                $subscription->user_id = $user->id;
                $subscription->type = 1;
                $subscription->price = $price;
                $subscription->start = $start;
                $subscription->end = $end;
                $subscription->save();
            }
        });

        return back()->with('success', trans('words.subscription-added'));
    }
}
