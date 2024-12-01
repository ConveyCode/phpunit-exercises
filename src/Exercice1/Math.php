<?php

declare(strict_types=1);

namespace Conveycode\PhpunitExercices\Exercice1;

final class Math
{
    private const SCALE = 10;

    public function __construct(
        private float $number = 0.0
    ) {
    }

    public function sum(float $number): void
    {
        $this->number = (float) bcadd((string) $this->number, (string) $number, self::SCALE);
    }

    public function substract(float $number): void
    {
        $this->number -= $number;
    }

    public function divide(float $number): void
    {
        $this->number /= $number;
    }

    public function multiply(float $number): void
    {
        $this->number *= $number;
    }

    public function getNumber(): float
    {
        return $this->number;
    }
}
