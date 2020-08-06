<?php


namespace App;


use Exception;
use JonnyW\PhantomJs\Client;

class Crawler
{
    public static function crawl($url)
    {
        try {
            $client = Client::getInstance();
            $client->getEngine()->setPath($_ENV['PhantomJsClientEnginePath']);

            $request = $client->getMessageFactory()->createRequest($url, 'GET', 5000);
            $response = $client->getMessageFactory()->createResponse();

            $client->send($request, $response);

            if ($response->getStatus() === 200) {
                return $response->getContent();
            }
        } catch (Exception $e) {
            echo 'error';
            exit;
        }
    }
}