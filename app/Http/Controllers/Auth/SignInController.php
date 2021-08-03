<?php

namespace App\Http\Controllers\Auth;

use App\Enums\SignInActivityTypes;
use App\Http\Controllers\Controller;
use App\Models\SignInActivity;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SignInController extends Controller
{
    public function show()
    {
        return view('pages.auth.sign-in');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function request(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $credential = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $signInActivity = new SignInActivity();
        $signInActivity->ip = $request->getClientIp() ?? 'N/A';
        $signInActivity->agent = $request->userAgent() ?? 'N/A';

        if (Auth::attempt($credential, true)) {
            $signInActivity->user_id = Auth::id();
            $signInActivity->type = SignInActivityTypes::SUCCESSFUL;
            $signInActivity->save();

            return redirect()->route('admin.dashboard');
        }

        $user = User::whereEmail($credential['email'])->first();
        $signInActivity->user_id = $user ? $user->id : 0;
        $signInActivity->type = SignInActivityTypes::FAILED;
        $signInActivity->save();

        return back()->with(['error' => trans('auth.failed')]);
    }
}
