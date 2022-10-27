<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\DetalleExenta;

/**
 * Class to perform TicketBAI system 'DetalleExenta' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class DetalleExentaTest extends TestEntity
{
    public function testValidDetalleExenta(): void
    {
        $detalleExenta = new DetalleExenta();
        $detalleExenta
            ->setCausaExencion("E1")
            ->setBaseImponible("10,00");

        self::assertIsValid($detalleExenta);
    }

    public function testNotValidDetalleExenta(): void
    {
        $detalleExenta = new DetalleExenta();

        self::assertIsNotValid($detalleExenta);

        $detalleExenta
            ->setCausaExencion("e1")
            ->setBaseImponible("0.001");

        self::assertCountConstraintViolations(2, $detalleExenta);
    }
}