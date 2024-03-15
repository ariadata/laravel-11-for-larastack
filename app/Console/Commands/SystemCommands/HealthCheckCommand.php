<?php

namespace App\Console\Commands\SystemCommands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class HealthCheckCommand extends Command
{
    protected $signature = 'app:health-check';

    protected $description = 'Check the health of the application';

    public function handle()
    {
        $this->info('Running health checks...');

        // Check database connection
        // $this->checkDatabaseConnection();

        // Check cache
        $this->checkCache();

        $this->info('Health checks passed!');
    }

    protected function checkDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            $this->info('Database connection: OK');
        } catch (\Exception $e) {
            $this->error('Database connection: FAILED');
            $this->error($e->getMessage());
        }
    }

    protected function checkCache()
    {
        try {
            Cache::put('health-check', 'ok', 1);
            Cache::forget('health-check');
            $this->info('Cache: OK');
        } catch (\Exception $e) {
            $this->error('Cache: FAILED');
            $this->error($e->getMessage());
        }
    }
}
