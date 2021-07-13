<?php

namespace App\Controller;

use App\Action\ApiKeyAndSignatureHttpClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpotController extends AbstractController
{
    #[Route('/place-order', name: 'place_order')]
    public function placeOrder(ApiKeyAndSignatureHttpClient $client): Response
    {
        $response = $client->request(Request::METHOD_GET, '/api/v3/myTrades', [
            'query' => [
                'symbol' => 'BNBUSDT',
            ],
        ]);

        return $this->json($response->toArray(false));
    }
}
