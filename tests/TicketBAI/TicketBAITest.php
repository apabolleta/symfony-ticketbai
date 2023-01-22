<?php

namespace APM\TicketBAIBundle\Tests\TicketBAI;

use PHPUnit\Framework\TestCase;

use APM\TicketBAIBundle\TicketBAI\TicketBAI;
use APM\TicketBAIBundle\TicketBAI\Response;
use APM\TicketBAIBundle\TicketBAI\Alta\FicheroAlta;
use APM\TicketBAIBundle\TicketBAI\Alta\Cabecera;
use APM\TicketBAIBundle\TicketBAI\Alta\Sujetos;
use APM\TicketBAIBundle\TicketBAI\Alta\Emisor;
use APM\TicketBAIBundle\TicketBAI\Alta\Factura;
use APM\TicketBAIBundle\TicketBAI\Alta\CabeceraFactura;
use APM\TicketBAIBundle\TicketBAI\Alta\DatosFactura;
use APM\TicketBAIBundle\TicketBAI\Alta\IDDetalleFactura;
use APM\TicketBAIBundle\TicketBAI\Alta\IDClave;
use APM\TicketBAIBundle\TicketBAI\Alta\TipoDesglose;
use APM\TicketBAIBundle\TicketBAI\Alta\DesgloseFactura;
use APM\TicketBAIBundle\TicketBAI\Alta\DetalleNoSujeta;
use APM\TicketBAIBundle\TicketBAI\Alta\HuellaTBAI;
use APM\TicketBAIBundle\TicketBAI\Alta\SoftwareTicketBAI;
use APM\TicketBAIBundle\TicketBAI\Alta\PersonaOEntidadDesarrolladora;

/**
 * Class to perform TicketBAI system operation tests.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class TicketBAITest extends TestCase
{
    public function testTicketBAI(): void
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
                                    ->setCantidad("1")
                                    ->setImporteUnitario("3.00")
                                    ->setImporteTotal("3.00")
                            ])
                            ->setImporteTotalFactura("3.00")
                            ->setClaves([
                                (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("01"),
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
                                            ->setImporte("1.00")
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
                            ->setNombre("apabolleta/symfony-ticketbai")
                            ->setVersion("0.0.1")
                    )
            );

        $ticketBAI = new TicketBAI();

        $response = $ticketBAI->alta($ficheroAlta);

        self::assertInstanceOf(Response::class, $response);
    }
}