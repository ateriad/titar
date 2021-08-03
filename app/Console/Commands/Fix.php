<?php

namespace App\Console\Commands;

use App\Models\Video;
use App\Models\VideoAttribute;
use Illuminate\Console\Command;

class Fix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video:addr:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (VideoAttribute::all() as $attribute) {
            $attribute->value = str_replace('https://files.titar.ir/', 'https://titar.ir/fs1/', $attribute->value);
            $attribute->save();
            echo 'DONE';
        }

        return 0;
    }
}
