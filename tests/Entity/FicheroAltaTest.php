<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\FicheroAlta;
use APM\TicketBAIBundle\Entity\Cabecera;
use APM\TicketBAIBundle\Entity\Sujetos;
use APM\TicketBAIBundle\Entity\Emisor;
use APM\TicketBAIBundle\Entity\IDDestinatario;
use APM\TicketBAIBundle\Entity\Factura;
use APM\TicketBAIBundle\Entity\CabeceraFactura;
use APM\TicketBAIBundle\Entity\DatosFactura;
use APM\TicketBAIBundle\Entity\TipoDesglose;
use APM\TicketBAIBundle\Entity\IDDetalleFactura;
use APM\TicketBAIBundle\Entity\IDClave;
use APM\TicketBAIBundle\Entity\DesgloseFactura;
use APM\TicketBAIBundle\Entity\DetalleNoSujeta;
use APM\TicketBAIBundle\Entity\HuellaTBAI;
use APM\TicketBAIBundle\Entity\SoftwareTicketBAI;
use APM\TicketBAIBundle\Entity\PersonaOEntidadDesarrolladora;
use APM\TicketBAIBundle\Entity\IDOtro;

/**
 * Class to perform TicketBAI system 'FicheroAlta' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class FicheroAltaTest extends TestEntity
{
    public function testValidFicheroAlta(): void
    {
        $ficheroAlta = new FicheroAlta();
        $ficheroAlta
            ->setCabecera(
                (new Cabecera())
                    ->setIDVersionTBAI("1.2")
            )
            ->setSujetos(
                (new Sujetos())
                    ->setEmisor(
                        (new Emisor())
                            ->setNIF("12345678A")
                            ->setApellidosNombreRazonSocial("Apellidos, Nombre")
                    )
            )
            ->setFactura(
                (new Factura())
                    ->setCabeceraFactura(
                        (new CabeceraFactura())
                            ->setNumFactura("0001")
                            ->setFechaExpedicionFactura("01-01-2022")
                            ->setHoraExpedicionFactura("10:00:00")
                    )
                    ->setDatosFactura(
                        (new DatosFactura())
                            ->setDescripcionFactura("Descripción general de las operaciones.")
                            ->setDetallesFactura([
                                (new IDDetalleFactura())
                                    ->setDescripcionDetalle("Descripción del detalle de la línea de factura.")
                                    ->setCantidad("1,00")
                                    ->setImporteUnitario("1,00")
                                    ->setImporteTotal("1,00"),
                                (new IDDetalleFactura())
                                    ->setDescripcionDetalle("Descripción del detalle de la línea de factura.")
                                    ->setCantidad("1,00")
                                    ->setImporteUnitario("1,00")
                                    ->setImporteTotal("1,00"),
                                (new IDDetalleFactura())
                                    ->setDescripcionDetalle("Descripción del detalle de la línea de factura.")
                                    ->setCantidad("1,00")
                                    ->setImporteUnitario("1,00")
                                    ->setImporteTotal("1,00")
                            ])
                            ->setImporteTotalFactura("3,00")
                            ->setClaves([
                                (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("01")
                            ])
                    )
                    ->setTipoDesglose(
                        (new TipoDesglose())
                            ->setDesgloseFactura(
                                (new DesgloseFactura())
                                    ->setNoSujeta([
                                        (new DetalleNoSujeta())
                                            ->setCausa("OT")
                                            ->setImporte("1,00")
                                    ])
                            )
                    )
            )
            ->setHuellaTBAI(
                (new HuellaTBAI())
                    ->setSoftwareTicketBAI(
                        (new SoftwareTicketBAI())
                            ->setLicenciaTBAI("1122334455")
                            ->setPersonaOEntidadDesarrolladora(
                                (new PersonaOEntidadDesarrolladora())
                                    ->setNIF("12345678A")
                            )
                            ->setNombre("Symfony Bundle for TicketBAI system")
                            ->setVersion("0.0.1")
                    )
            );

        self::assertIsValid($ficheroAlta);
    }

    public function testNotValidFicheroAlta(): void
    {
        $ficheroAlta = new FicheroAlta();

        self::assertIsNotValid($ficheroAlta);

        $ficheroAlta
            ->setCabecera(
                (new Cabecera())
                    ->setIDVersionTBAI("v1.2")
            )
            ->setSujetos(
                (new Sujetos())
                    ->setEmisor(
                        (new Emisor())
                            ->setNIF("12345678A")
                            ->setApellidosNombreRazonSocial("Apellidos, Nombre")
                    )
                    ->setDestinatarios([
                        (new IDDestinatario()),
                        (new IDDestinatario()),
                        (new IDDestinatario())
                    ])
            )
            ->setFactura(
                (new Factura())
                    ->setCabeceraFactura(
                        (new CabeceraFactura())
                            ->setNumFactura("0001")
                            ->setFechaExpedicionFactura("2022-1-1")
                            ->setHoraExpedicionFactura("10:00:00,00")
                    )
                    ->setDatosFactura(
                        (new DatosFactura())
                            ->setDescripcionFactura("Descripción general de las operaciones.")
                            ->setDetallesFactura([
                                (new IDDetalleFactura())
                                    ->setDescripcionDetalle("Descripción del detalle de la línea de factura.")
                                    ->setCantidad("1,0000")
                                    ->setImporteUnitario("1,0000")
                                    ->setImporteTotal("1,0000"),
                                (new IDDetalleFactura())
                                    ->setDescripcionDetalle("Descripción del detalle de la línea de factura.")
                                    ->setCantidad("1,0000")
                                    ->setImporteUnitario("1,0000")
                                    ->setImporteTotal("1,0000"),
                                (new IDDetalleFactura())
                                    ->setDescripcionDetalle("Descripción del detalle de la línea de factura.")
                                    ->setCantidad("1,0000")
                                    ->setImporteUnitario("1,0000")
                                    ->setImporteTotal("1,0000")
                            ])
                            ->setImporteTotalFactura("3,00")
                            ->setClaves([
                                (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("01")
                            ])
                    )
                    ->setTipoDesglose(
                        (new TipoDesglose())
                            ->setDesgloseFactura(
                                (new DesgloseFactura())
                                    ->setNoSujeta([])
                            )
                    )
            )
            ->setHuellaTBAI(
                (new HuellaTBAI())
                    ->setSoftwareTicketBAI(
                        (new SoftwareTicketBAI())
                            ->setLicenciaTBAI("1122334455")
                            ->setPersonaOEntidadDesarrolladora(
                                (new PersonaOEntidadDesarrolladora())
                                    ->setNIF("12345678A")
                                    ->setIDOtro(new IDOtro())
                            )
                    )
            );

        self::assertCountConstraintViolations(16, $ficheroAlta);
    }
}