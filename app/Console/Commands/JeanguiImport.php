<?php

namespace App\Console\Commands;

use App\Jeangui\Importer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class JeanguiImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:jeangui-import {--migrate : Reset database first}';

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
        if ($this->option('migrate')) {
            Artisan::call('migrate:fresh');
        }
        Importer::run();
    }
}
