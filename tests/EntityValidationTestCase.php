<?php

namespace APM\TicketBAIBundle\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class to create custom assertions for entity validation.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class EntityValidationTestCase extends TestCase
{
    protected static function getValidator(): ValidatorInterface
    {
        return Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();
    }

    public static function assertIsValid($value, ...$args): void
    {
        $validator = self::getValidator();

        $violations = $validator->validate($value, ...$args);

        self::assertCount(0, $violations);
    }

    public static function assertIsNotValid($value, ...$args): void
    {
        $validator = self::getValidator();

        $violations = $validator->validate($value, ...$args);

        self::assertNotCount(0, $violations);
    }

    public static function assertCountConstraintViolations($expectedCount, $value, ...$args): void
    {
        $validator = self::getValidator();

        $violations = $validator->validate($value, ...$args);

        self::assertCount($expectedCount, $violations);
    }
}