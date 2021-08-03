<?php

namespace App\Http\Controllers\Front\Account;

use App\Http\Controllers\Controller;
use App\Jobs\Users\SendSmsVerification;
use App\Mail\EmailVerification;
use App\Models\User;
use App\Models\UserCellphoneChange;
use App\Models\UserEmailChange;
use App\Services\Utils\Random;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('pages.front.account.profile', [
            'tab' => 'profile'
        ]);
    }

    public function updateBasics(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
        ]);

        $user = auth()->user();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->save();

        return back()->with('success', trans('words.profile.basics-updated'));
    }

    public function updateEmail(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'max:255']
        ]);

        UserEmailChange::whereUserId(auth()->id())->delete();

        $email = new UserEmailChange();
        $email->user_id = auth()->id();
        $email->email = $request->input('email');
        $email->token = Random::alphabetic(32);
        $email->save();

        Mail::to($request->input('email'))
            ->send(new EmailVerification(auth()->user(), $email->token));

        return back()->with('success', trans('words.profile.email-update'));
    }

    public function verifyEmail(string $token)
    {
        $email = UserEmailChange::whereToken($token)->firstOrFail();

        User::whereId($email->user_id)
            ->update(['email' => $email->email, 'email_verified_at' => now()]);

        return redirect()->route('account.home')
            ->with('success', trans('words.profile.email-verified'));
    }

    public function updateCellphone(Request $request)
    {
        $this->validate($request, [
            'cellphone' => ['required', 'cellphone', 'max:11'],
        ]);

        UserCellphoneChange::whereUserId(auth()->id())->delete();

        $cellphone = new UserCellphoneChange();
        $cellphone->user_id = auth()->id();
        $cellphone->cellphone = $request->input('cellphone');
        $cellphone->token = Random::numeric(100000, 999999);
        $cellphone->save();

        $this->dispatch(new SendSmsVerification($cellphone, $cellphone->token));

        return redirect()->route('account.profile.cellphone.verify')
            ->with('success', trans('words.profile.cellphone-update'));
    }

    public function verifyCellphone()
    {
        $cellphone = UserCellphoneChange::whereUserId(auth()->id())->firstOrFail();
        return view('pages.front.account.cellphone_verify', [
            'tab' => 'profile',
            'cellphone' => $cellphone->cellphone,
        ]);
    }

    public function submitVerifyCellphone(Request $request)
    {
        $this->validate($request, [
            'token' => ['required', 'digits:6'],
        ]);

        $cellphone = UserCellphoneChange::whereUserId(auth()->id())->firstOrFail();
        if ($request->input('token') == $cellphone->token) {
            User::whereId($cellphone->user_id)->update(['cellphone' => $cellphone->cellphone, 'cellphone_verified_at' => now()]);

            return redirect()->route('account.home')
                ->with('success', trans('words.profile.cellphone-verified'));
        }

        return redirect()->route('account.profile');
    }
}
