<?php

declare(strict_types=1);

namespace Conveycode\PhpunitExercices\Exercice2;

use Conveycode\PhpunitExercices\Exercice1\Math;

final class Cart
{
    /**
     * @param Product[] $products
     */
    public function __construct(
        private readonly array $products = []
    ) {
    }

    public function getProductCartPrice(): float
    {
        $math = new Math();
        foreach ($this->products as $product) {
            $math->sum($product->price);
        }

        match(true) {
            $math->getNumber() < 100 => $math->sum(15.5),
            $math->getNumber() === 100.0 => $math->sum(15),
            default => $math->sum(10),
        };

        return $math->getNumber();
    }
}
