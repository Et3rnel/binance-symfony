<?php

namespace App\Controller;

use App\Action\GetExchangeInfoAction;
use App\Action\PostMarketOrderAction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpotController extends AbstractController
{
    #[Route('/spot', name: 'spot')]
    public function placeOrder(
        GetExchangeInfoAction $getExchangeInfoAction,
        PostMarketOrderAction $postMarketOrderAction
    ): Response
    {
        return $this->json($postMarketOrderAction->call()->toArray(false));
    }
}
