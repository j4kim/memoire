<?php

namespace App\Console\Commands;

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
    protected $description = 'Import data from Jeangui database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->comment("Start jeangui import");

        if ($this->option('migrate')) {
            $this->comment("Run migrate:refresh --step 12");
            $this->call('migrate:refresh', ['--step' => 12]);
            $this->info("Database refreshed");
        }

        $models = [
            \App\Jeangui\Models\Lieu::class,
            \App\Jeangui\Models\Motmatiere::class,
            \App\Jeangui\Models\Personne::class,
            \App\Jeangui\Models\Fond::class,
            \App\Jeangui\Models\Lot::class,
            \App\Jeangui\Models\Document::class,
        ];

        foreach ($models as $model) {
            $this->comment("Start import for $model");
            $model::import();
            $this->info("$model imported");
        }
    }
}
