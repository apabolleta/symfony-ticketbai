<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\Cabecera;

/**
 * Class to perform TicketBAI system 'Cabecera' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class CabeceraTest extends TestEntity
{
    public function testValidCabecera(): void
    {
        $cabecera = new Cabecera();
        $cabecera->setIDVersionTBAI("1.2");

        self::assertIsValid($cabecera);
    }

    public function testNotValidCabecera(): void
    {
        $cabecera = new Cabecera();

        self::assertIsNotValid($cabecera);

        $cabecera->setIDVersionTBAI("v12345");

        self::assertCountConstraintViolations(2, $cabecera);
    }
}