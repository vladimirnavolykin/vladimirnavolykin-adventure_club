<?php

/**
 * Adventure club file header
 * Navolykin Vladimir (vladimirnavolykin@gmail.com).
 */

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

final class Operation
{
    public function __construct(
        #[Assert\NotBlank(message: 'arg1 must not be empty')]
        readonly public float $arg1,

        #[Assert\NotBlank(message: 'arg2 must not be empty')]
        readonly public float $arg2,

        #[Assert\Choice(['+', '-', '*', '/'], message: 'operator must be \'+\', \'-\', \'*\' or \'/\'')]
        readonly public string $operator,
    ) {
    }
}
