<?php

namespace App\Jobs\Products;

use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VisitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    private $productId;

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
     * @param int $userId
     * @param string $ip
     */
    public function __construct(int $productId, int $userId, string $ip, string $source)
    {
        $this->productId = $productId;
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
        $product_id = $this->productId;
        $user_id = $this->userId;
        $ip = $this->ip;
        $source = $this->source;
        $v = Visit::whereProductId($product_id)
            ->whereUserId($user_id)
            ->whereIp($ip)
            ->whereSource($source)
            ->whereDate('created_at', '>', Carbon::now()->subHours(24))
            ->first();

        if ($v == null) {
            $v = new Visit();
            $v->user_id = $this->userId;
            $v->product_id = $this->productId;
            $v->ip = $this->ip;
            $v->source = $this->source;
            $v->save();
        }
    }
}
