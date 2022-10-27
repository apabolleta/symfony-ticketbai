<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\DatosFactura;
use APM\TicketBAIBundle\Entity\IDDetalleFactura;
use APM\TicketBAIBundle\Entity\IDClave;

/**
 * Class to perform TicketBAI system 'DatosFactura' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class DatosFacturaTest extends TestEntity
{
    public function testValidDatosFactura(): void
    {
        $datosFactura = new DatosFactura();
        $datosFactura
            ->setDescripcionFactura("Descripción general de las operaciones.")
            ->setImporteTotalFactura("10000,00")
            ->setClaves([
                (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("01"),
                (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("02"),
                (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("03")
            ]);

        self::assertIsValid($datosFactura);

        $datosFactura
            ->setFechaOperacion("01-01-2022")
            ->setDetallesFactura([
                (new IDDetalleFactura())
                    ->setDescripcionDetalle("Descripción del detalle de la línea de factura.")
                    ->setCantidad("1,0")
                    ->setImporteUnitario("1,0")
                    ->setImporteTotal("1,0"),
                (new IDDetalleFactura())
                    ->setDescripcionDetalle("Descripción del detalle de la línea de factura.")
                    ->setCantidad("5,0")
                    ->setImporteUnitario("1,0")
                    ->setDescuento("0,5")
                    ->setImporteTotal("4,5")
            ])
            ->setRetencionSoportada("0,00")
            ->setBaseImponibleACoste("0,00");

        self::assertIsValid($datosFactura);
    }

    public function testNotValidDatosFactura(): void
    {
        $datosFactura = new DatosFactura();

        self::assertIsNotValid($datosFactura);

        $datosFactura
            ->setFechaOperacion("01/01/22")
            ->setDescripcionFactura("")
            ->setDetallesFactura([
                "Detalle 1",
                "Detalle 2",
                "Detalle 3"
            ])
            ->setImporteTotalFactura("1.00")
            ->setRetencionSoportada("1,0000")
            ->setBaseImponibleACoste("");

        self::assertCountConstraintViolations(9, $datosFactura);
    }
}