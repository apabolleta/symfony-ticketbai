<?php

namespace APM\TicketBAIBundle\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class to define basic Entity test class.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class TestEntity extends TestCase
{
    protected static function getValidatorInterface(): ValidatorInterface
    {
        return Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();
    }

    public static function assertIsValid($value, ...$args): void
    {
        $validator = self::getValidatorInterface();

        $violations = $validator->validate($value, ...$args);

        self::assertCount(0, $violations);
    }

    public static function assertIsNotValid($value, ...$args): void
    {
        $validator = self::getValidatorInterface();

        $violations = $validator->validate($value, ...$args);

        self::assertNotCount(0, $violations);
    }

    public static function assertCountConstraintViolations($expectedCount, $value, ...$args): void
    {
        $validator = self::getValidatorInterface();

        $violations = $validator->validate($value, ...$args);

        self::assertCount($expectedCount, $violations);
    }
}