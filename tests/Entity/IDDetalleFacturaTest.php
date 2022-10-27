<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\IDDetalleFactura;

/**
 * Class to perform TicketBAI system 'IDDetalleFactura' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class IDDetalleFacturaTest extends TestEntity
{
    public function testValidIDDetalleFactura(): void
    {
        $idDetalleFactura = new IDDetalleFactura();
        $idDetalleFactura
            ->setDescripcionDetalle("Descripción del detalle de la línea de factura.")
            ->setCantidad("10000,00")
            ->setImporteUnitario("0,00015")
            ->setImporteTotal("1,5");

        self::assertIsValid($idDetalleFactura);

        $idDetalleFactura
            ->setDescuento("0,5")
            ->setImporteTotal("1,0");

        self::assertIsValid($idDetalleFactura);
    }

    public function testNotValidIDDetalleFactura(): void
    {
        $idDetalleFactura = new IDDetalleFactura();

        self::assertIsNotValid($idDetalleFactura);

        $idDetalleFactura
            ->setDescripcionDetalle("")
            ->setCantidad("10000.0")
            ->setDescuento(",01")
            ->setImporteTotal("9999,99");

        self::assertCountConstraintViolations(4, $idDetalleFactura);
    }
}