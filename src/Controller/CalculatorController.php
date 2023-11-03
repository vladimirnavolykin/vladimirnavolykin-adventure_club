<?php

/**
 * Adventure club file header
 * Navolykin Vladimir (vladimirnavolykin@gmail.com).
 */

declare(strict_types=1);

namespace App\Controller;

use App\Model\Operation;
use App\Service\OperationHandler;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    #[Route(path: '/calculator', name: 'app_calculator', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] Operation $operation,
        OperationHandler $operationHandler,
        LoggerInterface $logger
    ): JsonResponse {
        try {
            $result = $operationHandler($operation);
        } catch (\DivisionByZeroError) {
            $message = "You can't divide by zero";
            $logger->error($message, ['operation' => $operation]);

            return new JsonResponse(['error' => $message], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Throwable $e) {
            $logger->critical($e->getMessage());

            return new JsonResponse(['error' => 'Unknown error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json([
            'result' => $result,
        ]);
    }
}
