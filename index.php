<?php

require_once "./vendor/autoload.php";

use App\Crawler;
use App\ShopeeHtmlContentFilter;
use App\SimplifiedChineseConverter;

$url = 'https://shopee.tw/%E7%8E%A9%E5%85%B7-cat.75.2185?brands=5005&locations=-1&page=0&ratingFilter=4';
$shopeeHtmlContentFilter = new ShopeeHtmlContentFilter();
$simplifiedChineseConverter = new SimplifiedChineseConverter;

$content = Crawler::crawl($url);
//$contentPath = './files/content.html';
//$fp = fopen($contentPath, 'w');
//fwrite($fp, $content);

//$fp = fopen($contentPath, 'r');
//$content = fread($fp, filesize($contentPath));

// 0: name, 1: price
$products = $shopeeHtmlContentFilter->filterProducts($content);

foreach ($products as $product) {
    $name = $product[0];
    $price = $product[1];

    $name = $simplifiedChineseConverter->convertToCN($name);
    $name = $simplifiedChineseConverter->convertToHans($name);

    echo $name . ' ' . $price . "\n";
}
