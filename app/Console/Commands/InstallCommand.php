<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'shop:install';

    protected $description = 'Installation project';


    public function handle(): int
    {
        $this->call('migrate');
        $this->call('storage:link');

        return self::SUCCESS;
    }
}
