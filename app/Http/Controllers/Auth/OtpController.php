<?php

namespace App\Http\Controllers\Auth;

use App\Enums\SignInActivityTypes;
use App\Exceptions\ApiErrorException;
use App\Http\Controllers\Controller;
use App\Models\SignInActivity;
use App\Models\User;
use App\Services\Otp\Otp;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OtpController extends Controller
{
    public function show()
    {
        return view('pages.auth.otp');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ApiErrorException
     * @throws ValidationException
     */
    public function submit(Request $request)
    {
        $this->validate($request, [
            'cellphone' => ['required', 'cellphone'],
            'otp' => ['required', 'numeric', 'digits:6'],
        ]);

        $cellphone = $request->input('cellphone');

        /** @var Otp $otp */
        $otp = app(Otp::class);

        if ($otp->check($cellphone, $request->input('otp')) == false) {
            throw new ApiErrorException(trans('validation.exists', [
                'attribute' => trans('validation.attributes.otp'),
            ]));
        }

        $user = User::whereCellphone($cellphone)->first();

        if (empty($user)) {
            $user = new User();
            $user->cellphone = $cellphone;
            $user->cellphone_verified_at = Carbon::now();
            $user->save();
        }

        auth()->loginUsingId($user->id, true);

        $signInActivity = new SignInActivity();
        $signInActivity->ip = $request->getClientIp() ?? 'N/A';
        $signInActivity->agent = $request->userAgent() ?? 'N/A';
        $signInActivity->user_id = $user->id;
        $signInActivity->type = SignInActivityTypes::SUCCESSFUL;
        $signInActivity->save();

        $to = $user->isAdmin() ? route('admin.dashboard') : route('home');

        return new JsonResponse([
            'redirect' => $to,
        ]);
    }
}
