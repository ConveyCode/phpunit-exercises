<?php

declare(strict_types=1);

namespace Conveycode\PhpunitExercices\Tests\Exercice2;

use Conveycode\PhpunitExercices\Exercice2\Cart;
use Conveycode\PhpunitExercices\Exercice2\Product;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class CartTest extends TestCase
{
    #[DataProvider('provideCarts')]
    public function testGetProductCartPrice(array $products, float $result): void
    {
        $cart = new Cart($products);

        self::assertSame($result, $cart->getProductCartPrice());
    }

    public static function provideCarts(): \Generator
    {
        yield 'Prix inférieur à 100 => frais de port de 15,5' => [
            [
                new Product('un produit', 10.90),
                new Product('un 2ème produit',80.10),
            ],
            106.5
        ];

        yield 'Prix inférieur égale à 100 => frais de port de 15' => [
            [
                new Product('un produit', 80.1),
                new Product('un 2ème produit',10.1),
                new Product('un 3ème produit',9.8),
            ],
            115
        ];

        yield 'Prix supérieur à 100 => frais de port de 10' => [
            [
                new Product('un produit', 100),
                new Product('un 2ème produit', 10),
            ],
            120
        ];
    }
}
