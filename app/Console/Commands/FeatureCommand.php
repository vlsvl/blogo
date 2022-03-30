<?php

namespace App\Console\Commands;

use App\Jobs\TestJob;
use Illuminate\Console\Command;

class FeatureCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feature';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for testing some feature';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        TestJob::dispatch()->onQueue('orders');
        return 0;
    }
}
