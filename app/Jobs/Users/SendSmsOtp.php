<?php

namespace App\Jobs\Users;

use App\Services\Sms\Sms;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsOtp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $cellphone;

    /**
     * @var string
     */
    private $otp;

    /**
     * Create a new job instance.
     *
     * @param string $cellphone
     * @param string $otp
     */
    public function __construct(string $cellphone, string $otp)
    {
        $this->cellphone = $cellphone;
        $this->otp = $otp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /** @var Sms $sms */
        $sms = app(Sms::class);
        $sms->send($this->cellphone, trans('auth.otp-sms', ['otp' => $this->otp,]));
    }
}
