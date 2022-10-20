<?php

declare(strict_types=1);

namespace App\Components\User;

class FullNameDto
{
        public function __construct(
            private string $givenName,
            private string $familyName,
            private int $age
        )
        {
        }

    public function getGivenName(): string
    {
        return $this->givenName;
    }


    public function getFamilyName(): string
    {
        return $this->familyName;
    }


    public function getAge(): int
    {
        return $this->age;
    }
}