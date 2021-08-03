<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\ApiErrorException;
use App\Http\Controllers\Controller;
use App\Jobs\Users\SendSmsOtp;
use App\Mail\SendEmailOtp;
use App\Models\User;
use App\Services\Otp\Otp;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Mail;

class ProfileController extends Controller
{
    public function show()
    {
        return new JsonResponse(Auth::user());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['nullable', 'min:1', 'max:20'],
            'last_name' => ['nullable', 'min:1', 'max:20'],
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->save();

        return new JsonResponse($user);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function updateCellphoneRequest(Request $request)
    {
        $this->validate($request, [
            'cellphone' => ['required', 'cellphone', 'unique:users'],
        ]);

        $cellphone = $request->input('cellphone');

        /** @var Otp $otp */
        $otp = app(Otp::class);

        $this->dispatch(new SendSmsOtp($cellphone, $otp->store($cellphone)));

        return new JsonResponse([
            'expires_after' => config('otp.targets.sms.ttl'),
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ApiErrorException
     * @throws ValidationException
     */
    public function updateCellphoneSubmit(Request $request)
    {
        $this->validate($request, [
            'cellphone' => ['required', 'cellphone', 'unique:users'],
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

        /** @var User $user */
        $user = Auth::user();
        $user->cellphone = $cellphone;
        $user->cellphone_verified_at = Carbon::now();
        $user->save();

        return new JsonResponse($user);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function updateEmailRequest(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'unique:users'],
        ]);

        $email = $request->input('email');

        /** @var Otp $otp */
        $otp = app(Otp::class);

        Mail::to($email)->queue(new SendEmailOtp($otp->store($email)));

        return new JsonResponse([
            'expires_after' => config('otp.targets.email.ttl'),
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ApiErrorException
     * @throws ValidationException
     */
    public function updateEmailSubmit(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'unique:users'],
            'otp' => ['required', 'numeric', 'digits:6'],
        ]);

        $email = $request->input('email');

        /** @var Otp $otp */
        $otp = app(Otp::class);

        if ($otp->check($email, $request->input('otp')) == false) {
            throw new ApiErrorException(trans('validation.exists', [
                'attribute' => trans('validation.attributes.otp'),
            ]));
        }

        /** @var User $user */
        $user = Auth::user();
        $user->email = $email;
        $user->email_verified_at = Carbon::now();
        $user->save();

        return new JsonResponse($user);
    }
}
