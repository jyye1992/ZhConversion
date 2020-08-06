<?php

namespace App;

class ShopeeHtmlContentFilter
{
    private $DOMDocument;
    private $xpath;

    /**
     * ShopeeHtmlContentFilter constructor.
     */
    public function __construct()
    {
        $this->DOMDocument = new \DOMDocument;
    }

    public function filterProducts($content)
    {
        $this->setXpath($content);

        $names = $this->getProductNames();
        $prices = $this->getProductPrices();

        return $this->zipWithKey($names, $prices, 'name', 'price');
    }

    /**
     * @param $content
     */
    private function setXpath($content)
    {
        @$this->DOMDocument->loadHTML($content);
        $this->xpath = new \DOMXPath($this->DOMDocument);
    }

    private function getProductNames()
    {
        $nodes = $this->xpath->query('//*[@data-sqe="name"]/div');

        $names = [];
        foreach ($nodes as $node) {
            array_push($names, $node->textContent);
        }

        return $names;
    }

    /**
     * @return array
     */
    private function getProductPrices()
    {
        $priceNodes = $this->xpath->query('//*[@data-sqe="name"]/following-sibling::div[1]/div[1]');

        $prices = [];
        foreach ($priceNodes as $node) {
            array_push($prices, $node->nodeValue);
        }

        return $prices;
    }

    /**
     * @param array $array1
     * @param array $array2
     * @param $keyName1
     * @param $keyName2
     * @return array
     */
    private function zipWithKey(array $array1, array $array2, $keyName1, $keyName2)
    {
        return array_map(function ($arr1, $arr2) use ($keyName1, $keyName2) {
            return (object)[
                $keyName1 => $arr1,
                $keyName2 => $arr2,
            ];
        }, $array1, $array2);
    }
}