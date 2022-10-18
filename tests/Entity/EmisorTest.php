<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\Emisor;

/**
 * Class to perform TicketBAI system 'Emisor' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class EmisorTest extends TestEntity
{
    public function testValidEmisor(): void
    {
        $emisor = new Emisor();
        $emisor
            ->setNIF("12345678A")
            ->setApellidosNombreRazonSocial("Pabolleta Martorell, Asier");

        self::assertIsValid($emisor);

        $emisor = new Emisor();
        $emisor
            ->setNIF("87654321Z")
            ->setApellidosNombreRazonSocial("Company Name S.L.");

        self::assertIsValid($emisor);
    }

    public function testNotValidEmisor(): void
    {
        $emisor = new Emisor();

        self::assertIsNotValid($emisor);

        $emisor
            ->setNIF("73F")
            ->setApellidosNombreRazonSocial("");

        self::assertCountConstraintViolations(3, $emisor);
    }
}