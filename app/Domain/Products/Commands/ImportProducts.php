<?php

namespace App\Domain\Products\Commands;

use Illuminate\Console\Command;
use App\Domain\Supports\Fakes\FakesService;
use App\Domain\Products\Services\ProductsService;

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

    public function __construct(
        protected FakesService $fakesService,
        protected ProductsService $productsService
    )
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $productId = $this->option('id');
        $products = $this->fakesService->getProducts($productId);

        if ($products) {
            $importedCount = count($products);
            $this->info("Produtos obtidos com sucesso: {$importedCount} produtos para importar.");
            $this->productsService->import($products);
        } else {
            $this->error('Erro ao obter os produtos.');
        }

    }
}
