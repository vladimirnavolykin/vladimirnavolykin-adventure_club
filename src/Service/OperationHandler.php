<?php

/**
 * Adventure club file header
 * Navolykin Vladimir (vladimirnavolykin@gmail.com).
 */

declare(strict_types=1);

namespace App\Service;

use App\Model\Operation;

final class OperationHandler
{
    public function __invoke(Operation $operation): float
    {
        return match ($operation->operator) {
            '+' => $this->sum($operation->arg1, $operation->arg2),
            '-' => $this->diff($operation->arg1, $operation->arg2),
            '*' => $this->multi($operation->arg1, $operation->arg2),
            '/' => $this->div($operation->arg1, $operation->arg2),
        };
    }

    private function sum(float $arg1, float $arg2): float
    {
        return $arg1 + $arg2;
    }

    private function diff(float $arg1, float $arg2): float
    {
        return $arg1 - $arg2;
    }

    private function multi(float $arg1, float $arg2): float
    {
        return $arg1 * $arg2;
    }

    private function div(float $arg1, float $arg2): float
    {
        if (0.0 === $arg2) {
            throw new \DivisionByZeroError();
        }

        return $arg1 / $arg2;
    }
}
