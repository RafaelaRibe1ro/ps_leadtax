<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AmazonProduct;
use App\Models\Product;

class ScrapeAmazon extends Command
{
    protected $signature = 'scrape:amazon';
    protected $description = 'Scrapes product data from Amazon and saves it to the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $output = trim(shell_exec('node ' . base_path('amazonScrape.js') . ' 2>&1'));
        $products = json_decode($output, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Erro ao decodificar JSON: ' . json_last_error_msg());
            return 1;
        }

        foreach ($products as $product) {
            AmazonProduct::create([
                'title' => $product['title'],
                'price' => $product['price'],
                'image_url' => $product['image'],
            ]);
        }

        $this->info('Produtos da Amazon salvos com sucesso no banco de dados.');
        return 0;
    }
}
