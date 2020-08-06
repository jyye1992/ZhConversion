<?php


namespace App;


class SimplifiedChineseConverter
{

    /**
     * @param string $string
     */
    public function convertToCN($string)
    {
        foreach(ZhConversion::$zh2CN as $zh => $hans) {
            $string = preg_replace("/$zh/", $hans, $string);
        }

        return $string;
    }

    public function convertToHans($string)
    {
        foreach (ZhConversion::$zh2Hans as $zh => $hans) {
            $string = preg_replace("/$zh/", $hans, $string);
        }

        return $string;
    }
}