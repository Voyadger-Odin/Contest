<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class RedisTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        #Cache::put('test-key', 'test-data', now()->addMinutes(10));
        Cache::put('test-key', 'test-data');
        #Cache::forget('test-key');
        dd(Cache::get('test-key'));
        #dd(Redis::connection('connection-name'));
    }
}
