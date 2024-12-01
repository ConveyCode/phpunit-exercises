<?php

declare(strict_types=1);

namespace Conveycode\PhpunitExercices\Exercice2;

final class Product
{
    public function __construct(
        public readonly string $name,
        public readonly float $price,
    ) {
    }
}
