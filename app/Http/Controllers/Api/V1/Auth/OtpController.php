<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Exceptions\ApiErrorException;
use App\Http\Controllers\Controller;
use App\Jobs\Users\SendSmsOtp;
use App\Models\User;
use App\Services\Otp\Otp;
use App\Services\Token\Token;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OtpController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function request(Request $request)
    {
        $this->validate($request, [
            'cellphone' => ['required', 'cellphone'],
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

        /** @var Token $token */
        $token = app(Token::class);

        return new JsonResponse([
            'token' => $token->generate($user->id),
            'user' => $user,
        ]);
    }
}
