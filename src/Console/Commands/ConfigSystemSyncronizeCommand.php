<?php

namespace TheBachtiarz\Finance\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use TheBachtiarz\Finance\Helpers\ConfigSystemHelper;

class ConfigSystemSyncronizeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thebachtiarz:finance:config:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Finance: Syncronize config system from server';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $this->info('======> Finance config system syncronizing: start');
            Log::channel('application')->info("----> Finance config system syncronizing: start");

            ConfigSystemHelper::syncConfigAttributesFromServer();

            $this->info('======> Finance config system syncronizing: finish');
            Log::channel('application')->info("----> Finance config system syncronizing: finish");

            return Command::SUCCESS;
        } catch (\Throwable $th) {
            $this->warn('======> Finance config system syncronizing: failed | ' . $th->getMessage());
            Log::channel('application')->warning("----> Finance config system syncronizing: failed | " . $th->getMessage());

            return Command::FAILURE;
        }
    }
}
