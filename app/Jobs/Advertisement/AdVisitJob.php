<?php

namespace App\Jobs\Advertisement;

use App\Models\AdVisit;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AdVisitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    private $productId;

    /**
     * @var int
     */
    private $advertisementId;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $source;

    /**
     * Create a new job instance.
     *
     * @param int $productId
     * @param int $advertisementId
     * @param int $userId
     * @param string $ip
     * @param string $source
     */
    public function __construct(int $productId, int $advertisementId, int $userId, string $ip, string $source)
    {
        $this->productId = $productId;
        $this->advertisementId = $advertisementId;
        $this->userId = $userId;
        $this->ip = $ip;
        $this->source = $source;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $v = AdVisit::whereProductId($this->productId)
            ->whereUserId($this->userId)
            ->whereAdvertisementId($this->advertisementId)
            ->whereIp($this->ip)
            ->whereSource($this->source)
            ->whereDate('created_at', '>', Carbon::now()->subHours(24))
            ->first();

        if ($v == null) {
            $v = new AdVisit();
            $v->user_id = $this->userId;
            $v->product_id = $this->productId;
            $v->advertisement_id = $this->advertisementId;
            $v->ip = $this->ip;
            $v->source = $this->source;
            $v->save();
        }
    }
}
