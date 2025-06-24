<?php

namespace App\Console\Commands;

use App\Jeangui\Importer;
use Illuminate\Console\Command;

class JeanguiImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:jeangui-import';

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
        Importer::run();
    }
}
