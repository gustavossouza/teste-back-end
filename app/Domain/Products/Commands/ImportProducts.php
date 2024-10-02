<?php

namespace App\Domain\Products\Commands;

use Illuminate\Console\Command;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import {--id= : The ID of the product to import}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products, optionally by product ID';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->option('id');
    }
}
