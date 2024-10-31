<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Product;

class ScrapeProducts extends Command
{
    protected $signature = 'scrape:products {query=gaming}';
    protected $description = 'Scrape products from Mercado Livre and save to database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $client = HttpClient::create();

        $query = $this->argument('query');

        $response = $client->request('GET', "https://api.mercadolibre.com/sites/MLB/search?q={$query}");
        $data = json_decode($response->getContent(), true);

        if (isset($data['results']) && count($data['results']) > 0) {
            foreach ($data['results'] as $item) {
                try {
                    $name = $item['title'];
                    $price = $item['price'];
                    $description = $item['title'];
                    $image_url = isset($item['thumbnail']) ? $item['thumbnail'] : null;

                    Product::create([
                        'name' => $name,
                        'price' => $price,
                        'description' => $description,
                        'image_url' => $image_url,
                    ]);

                    $this->info("Produto '{$name}' salvo com sucesso!");
                } catch (\Exception $e) {
                    $this->error("Erro ao salvar produto '{$name}': " . $e->getMessage());
                }
            }

            $this->info('Scraping concluído.');
        } else {
            $this->warn('Nenhum produto encontrado para o termo de busca.');
        }
    }
}
