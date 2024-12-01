<?php

declare(strict_types=1);

namespace Conveycode\PhpunitExercices\Tests\Exercice2;

use Conveycode\PhpunitExercices\Exercice2\Product;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    public function testProduct(): void
    {
        $product = new Product('Product 1', 10.50);

        self::assertSame('Product 1', $product->name);
        self::assertSame(10.50, $product->price);
    }
}
