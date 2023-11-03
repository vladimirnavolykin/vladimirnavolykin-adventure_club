<?php

/**
 * Adventure club file header
 * Navolykin Vladimir (vladimirnavolykin@gmail.com).
 */

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Age
{
    public function __construct(
        #[Assert\NotBlank(message: 'birthday must not be empty')]
        readonly public \DateTimeImmutable $birthday,

        readonly public ?\DateTimeImmutable $actualDate = null,
    ) {
    }
}
