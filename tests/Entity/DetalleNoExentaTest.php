<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\DetalleNoExenta;
use APM\TicketBAIBundle\Entity\DetalleIVA;

/**
 * Class to perform TicketBAI system 'DetalleNoExenta' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class DetalleNoExentaTest extends TestEntity
{
    public function testValidDetalleNoExenta(): void
    {
        $detalleNoExenta = new DetalleNoExenta();
        $detalleNoExenta
            ->setTipoNoExenta("S1")
            ->setDesgloseIVA([
                (new DetalleIVA())->setBaseImponible("1,00"),
                (new DetalleIVA())->setBaseImponible("1,99"),
                (new DetalleIVA())->setBaseImponible("2,00")
            ]);

        self::assertIsValid($detalleNoExenta);
    }

    public function testNotValidDetalleNoExenta(): void
    {
        $detalleNoExenta = new DetalleNoExenta();

        self::assertIsNotValid($detalleNoExenta);

        $detalleNoExenta
            ->setTipoNoExenta("s1")
            ->setDesgloseIVA([
                (new DetalleIVA()),
                (new DetalleIVA()),
                (new DetalleIVA()),
                (new DetalleIVA()),
                (new DetalleIVA()),
                (new DetalleIVA()),
                (new DetalleIVA()),
                (new DetalleIVA()),
                (new DetalleIVA()),
                (new DetalleIVA())
            ]);

        self::assertCountConstraintViolations(12, $detalleNoExenta);
    }
}