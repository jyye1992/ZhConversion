<?php
require_once "./config/path.php";
require_once "./vendor/autoload.php";

use App\Crawler;
use App\ShopeeHtmlContentFilter;
use App\SimplifiedChineseConverter;

$url = 'https://shopee.tw/%E7%8E%A9%E5%85%B7-cat.75.2185?brands=5005&locations=-1&page=0&ratingFilter=4';
$shopeeHtmlContentFilter = new ShopeeHtmlContentFilter();
$simplifiedChineseConverter = new SimplifiedChineseConverter;

$content = Crawler::crawl($url);
$products = $shopeeHtmlContentFilter->filterProducts($content);

foreach ($products as $product) {
    $product->name = $simplifiedChineseConverter->convertToCN($product->name);
    $product->name = $simplifiedChineseConverter->convertToHans($product->name);

    echo $product->name . ' ' . $product->price . "\n";
}
