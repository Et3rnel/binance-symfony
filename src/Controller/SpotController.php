<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SpotController extends AbstractController
{
    #[Route('/place-order', name: 'place_order')]
    public function placeOrder(HttpClientInterface $client): Response
    {
        /** @var HttpClientInterface $client */
        $client = $client->withOptions([
                                           'base_uri' => 'https://api.binance.com/',

                                       ]);

        $milliseconds = round(microtime(true) * 1000);

        $queryString = http_build_query(
            [
                'timestamp' => $milliseconds
            ]
        );

//        return $this->json($queryString);

        $signature = hash_hmac(
            'sha256',
            $queryString,
            ''
        );

//        'timestamp' => $milliseconds

        $response = $client->request(Request::METHOD_POST, "/api/v3/order/test?{$queryString}", [
            'query' => [
                'signature' => $signature,
            ],
            'body' => [
                'symbol' => 'todo'
            ],
            'headers' => [
                'X-MBX-APIKEY' => '',
            ]
        ]);

        return $this->json($response->toArray(false));
    }

    #[Route('/spot', name: 'spot')]
    public function index(HttpClientInterface $client): Response
    {
        /** @var HttpClientInterface $client */
        $client = $client->withOptions([
             'base_uri' => 'https://api.binance.com/',

         ]);

        $milliseconds = round(microtime(true) * 1000);

        $queryString = http_build_query(
            [
                'timestamp' => $milliseconds
            ]
        );

//        return $this->json($queryString);

        $signature = hash_hmac(
            'sha256',
            $queryString,
            ''
        );

//        'timestamp' => $milliseconds

        $response = $client->request('GET', "api/v3/allOrderList?{$queryString}", [
            'query' => [
                'signature' => $signature,
            ],
            'headers' => [
                'X-MBX-APIKEY' => '',
            ]
        ]);

        return $this->json($response->toArray(false));
    }
}
