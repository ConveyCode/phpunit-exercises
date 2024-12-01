<?php

declare(strict_types=1);

namespace Conveycode\PhpunitExercices\Tests\Exercice1;

use Conveycode\PhpunitExercices\Exercice1\Math;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testEmptyNumber(): void
    {
        $math = new Math();

        self::assertSame((float) 0, $math->getNumber());
    }

    #[DataProvider('sumProvider')]
    public function testSumNumber(float $firstNum, float $secondNum, float $result): void
    {
        $math = new Math($firstNum);
        $math->sum($secondNum);

        self::assertSame($result, $math->getNumber());
    }

    public static function sumProvider()
    {
        return [
            [1, 2, 3],
            [2.50, 4.50, 7],
            [10.88, 20.12, 31]
        ];
    }

    public function testSubstractNumber(): void
    {
        $math = new Math();
        $math->sum(2);
        $math->substract(1);

        self::assertSame((float) 1, $math->getNumber());
    }

    public function testDivideNumber(): void
    {
        $math = new Math();
        $math->sum(6);
        $math->divide(2);

        self::assertSame((float) 3, $math->getNumber());
    }

    public function testMultiplyNumber(): void
    {
        $math = new Math();
        $math->sum(5);
        $math->multiply(4);

        self::assertSame((float) 20, $math->getNumber());
    }
}
