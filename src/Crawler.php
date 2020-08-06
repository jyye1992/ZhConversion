<?php


namespace App;


use JonnyW\PhantomJs\Client;

class Crawler
{
    public static function crawl($url)
    {
        try {
            $client = Client::getInstance();
            $client->getEngine()->setPath('D:\path\to\your\project\in\bin\phantomjs.exe');


            $request = $client->getMessageFactory()->createRequest($url, 'GET', 5000);
            $response = $client->getMessageFactory()->createResponse();

            $client->send($request, $response);

            if ($response->getStatus() === 200) {
                return $response->getContent();
            }
        } catch (\Exception $e) {
            echo 'error';
            exit;
        }
    }
}