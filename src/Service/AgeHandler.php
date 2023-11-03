<?php

/**
 * Adventure club file header
 * Navolykin Vladimir (vladimirnavolykin@gmail.com).
 */

declare(strict_types=1);

namespace App\Service;

use App\Model\Age;

final class AgeHandler
{
    public function __invoke(Age $age): int
    {
        $actualDate = $age->actualDate;
        if (null === $actualDate) {
            $actualDate = new \DateTimeImmutable();
        }

        // todo:возможно нужно генерировать исключение
        if ($age->birthday->getTimestamp() > $actualDate->getTimestamp()) {
            return 0;
        }

        return $age->birthday->diff($actualDate)->y;
    }
}
