<?php

declare(strict_types=1);

namespace Conveycode\PhpunitExercices\Tests\ExerciceEmailValidator;

use Conveycode\PhpunitExercices\ExerciceEmailValidator\EmailValidator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class EmailValidatorTest extends TestCase
{
    #[DataProvider('provideValidateResult')]
    public function testValidEmail(string $responseBody, string $email, bool $isValid): void
    {
        $mockHandler = new MockHandler([
            new Response(200, [], $responseBody),
        ]);
        $emailValidator = new EmailValidator(new Client(['handler' => $mockHandler]));
        $this->assertSame($isValid, $emailValidator->validate($email));
    }

    public static function provideValidateResult(): \Generator
    {
        yield 'Valid email' => [
            '{"format": true}',
            'email@valide.fr',
            true
        ];

        yield 'Invalid email' => [
            '{"format": false}',
            'invalidEmail',
            false
        ];
    }

    public function testItCallCorrectlyUrlApi(): void
    {
        $mockHandler = new MockHandler([
            new Response(200, [], ''),
        ]);
        $emailValidator = new EmailValidator(new Client(['handler' => $mockHandler]));
        $emailValidator->validate('email@valide.fr');
        self::assertSame('https://email.verify/email@valide.fr', $mockHandler->getLastRequest()->getUri()->__toString());
    }

    public function testItReturnFalseWhenRequestExceptionIsTriggered(): void
    {
        $mockHandler = new MockHandler([
            new RequestException('une 404', new Request('GET', 'https://email.verify/mon@email.fr')),
        ]);
        $emailValidator = new EmailValidator(new Client(['handler' => $mockHandler]));

        self::assertFalse($emailValidator->validate('mon@email.fr'));
    }

    public function testItReturnFalseWhenServerExceptionIsTriggered(): void
    {
        $mockHandler = new MockHandler([
            new ServerException('une 500', new Request('GET', 'https://email.verify/mon@email.fr'), new Response(500)),
        ]);
        $emailValidator = new EmailValidator(new Client(['handler' => $mockHandler]));

        self::assertFalse($emailValidator->validate('mon@email.fr'));
    }
}
