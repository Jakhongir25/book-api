<?php

declare(strict_types=1);

namespace App\Components\User;

class MaxAgeDto
{
    public function __construct(
        private int $maxAge
    ) {
    }

    public function getMaxAge(): int
    {
        return $this->maxAge;
    }
}