<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\Factura;
use APM\TicketBAIBundle\Entity\CabeceraFactura;
use APM\TicketBAIBundle\Entity\DatosFactura;
use APM\TicketBAIBundle\Entity\TipoDesglose;
use APM\TicketBAIBundle\Entity\IDDetalleFactura;
use APM\TicketBAIBundle\Entity\IDClave;
use APM\TicketBAIBundle\Entity\DesgloseFactura;
use APM\TicketBAIBundle\Entity\Sujeta;
use APM\TicketBAIBundle\Entity\DetalleExenta;

/**
 * Class to perform TicketBAI system 'Factura' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class FacturaTest extends TestEntity
{
    public function testValidFactura(): void
    {
        $factura = new Factura();
        $factura
            ->setCabeceraFactura(
                (new CabeceraFactura())
                    ->setNumFactura("0001")
                    ->setFechaExpedicionFactura("01-01-2022")
                    ->setHoraExpedicionFactura("10:10:00")
            )
            ->setDatosFactura(
                (new DatosFactura())
                    ->setDescripcionFactura("Descripción general de las operaciones.")
                    ->setDetallesFactura([
                        (new IDDetalleFactura())
                            ->setDescripcionDetalle("Descripción del detalle de la línea de factura.")
                            ->setCantidad("10,00")
                            ->setImporteUnitario("10,00")
                            ->setImporteTotal("100,00"),
                        (new IDDetalleFactura())
                            ->setDescripcionDetalle("Descripción del detalle de la línea de factura.")
                            ->setCantidad("1,00")
                            ->setImporteUnitario("1,00")
                            ->setImporteTotal("1,00"),
                    ])
                    ->setImporteTotalFactura("101,00")
                    ->setClaves([
                        (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("01"),
                        (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("02"),
                        (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("03")
                    ])
            )
            ->setTipoDesglose(
                (new TipoDesglose())
                    ->setDesgloseFactura(
                        (new DesgloseFactura())
                            ->setSujeta(
                                (new Sujeta())
                                    ->setExenta([
                                        (new DetalleExenta())
                                            ->setCausaExencion("E1")
                                            ->setBaseImponible("1,00"),
                                        (new DetalleExenta())
                                            ->setCausaExencion("E2")
                                            ->setBaseImponible("1,00"),
                                        (new DetalleExenta())
                                            ->setCausaExencion("E3")
                                            ->setBaseImponible("1,00")
                                    ])
                            )
                    )
            );

        self::assertIsValid($factura);
    }

    public function testNotValidFactura(): void
    {
        $factura = new Factura();

        self::assertIsNotValid($factura);

        $factura
            ->setCabeceraFactura(
                (new CabeceraFactura())
                    ->setNumFactura("0001")
                    ->setFechaExpedicionFactura("2022-1-1")
                    ->setHoraExpedicionFactura("10:10:00")
            )
            ->setDatosFactura(
                (new DatosFactura())
                    ->setDescripcionFactura("Descripción general de las operaciones.")
                    ->setDetallesFactura([
                        (new IDDetalleFactura())
                            ->setDescripcionDetalle("")
                            ->setCantidad("10,00")
                            ->setImporteUnitario("10,00")
                            ->setImporteTotal("100,00"),
                        (new IDDetalleFactura())
                            ->setDescripcionDetalle("")
                            ->setCantidad("1,00")
                            ->setImporteUnitario("1,00")
                            ->setImporteTotal("1,00"),
                    ])
                    ->setImporteTotalFactura("101,00")
                    ->setClaves([
                        (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("01"),
                        (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("02"),
                        (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("03"),
                        (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("04"),
                        (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("FF")
                    ])
            );

        self::assertCountConstraintViolations(7, $factura);
    }
}