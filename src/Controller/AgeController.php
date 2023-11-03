<?php

/**
 * Adventure club file header
 * Navolykin Vladimir (vladimirnavolykin@gmail.com).
 */

declare(strict_types=1);

namespace App\Controller;

use App\Model\Age;
use App\Service\AgeHandler;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class AgeController extends AbstractController
{
    #[Route(path: '/age', name: 'app_age', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] Age $age,
        AgeHandler $ageHandler,
        LoggerInterface $logger
    ): JsonResponse {
        try {
            $result = $ageHandler($age);
        } catch (\Throwable $e) {
            $logger->critical($e->getMessage());

            return new JsonResponse(['error' => 'Unknown error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json([
            'age' => $result,
        ]);
    }
}
