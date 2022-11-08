<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\EntityValidationTestCase;
use APM\TicketBAIBundle\Entity\FicheroAlta;
use APM\TicketBAIBundle\Entity\Cabecera;
use APM\TicketBAIBundle\Entity\Sujetos;
use APM\TicketBAIBundle\Entity\Emisor;
use APM\TicketBAIBundle\Entity\IDDestinatario;
use APM\TicketBAIBundle\Entity\IDOtro;
use APM\TicketBAIBundle\Entity\Factura;
use APM\TicketBAIBundle\Entity\CabeceraFactura;
use APM\TicketBAIBundle\Entity\FacturaRectificativa;
use APM\TicketBAIBundle\Entity\ImporteRectificacionSustitutiva;
use APM\TicketBAIBundle\Entity\IDFacturaRectificadaSustituida;
use APM\TicketBAIBundle\Entity\DatosFactura;
use APM\TicketBAIBundle\Entity\IDDetalleFactura;
use APM\TicketBAIBundle\Entity\IDClave;
use APM\TicketBAIBundle\Entity\TipoDesglose;
use APM\TicketBAIBundle\Entity\DesgloseFactura;
use APM\TicketBAIBundle\Entity\Sujeta;
use APM\TicketBAIBundle\Entity\DetalleExenta;
use APM\TicketBAIBundle\Entity\DetalleNoExenta;
use APM\TicketBAIBundle\Entity\DetalleIVA;
use APM\TicketBAIBundle\Entity\DetalleNoSujeta;
use APM\TicketBAIBundle\Entity\DesgloseTipoOperacion;
use APM\TicketBAIBundle\Entity\PrestacionServicios;
use APM\TicketBAIBundle\Entity\Entrega;
use APM\TicketBAIBundle\Entity\HuellaTBAI;
use APM\TicketBAIBundle\Entity\EncadenamientoFacturaAnterior;
use APM\TicketBAIBundle\Entity\SoftwareTicketBAI;
use APM\TicketBAIBundle\Entity\PersonaOEntidadDesarrolladora;

/**
 * Class to perform TicketBAI 'FicheroAlta' structure validation tests.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class FicheroAltaTest extends EntityValidationTestCase
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
                            ->setImporteTotalFactura("3.00")
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

        self::assertIsValid($ficheroAlta);

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
                    ->setDestinatarios([
                        (new IDDestinatario())
                            ->setIDOtro(
                                (new IDOtro())
                                    ->setCodigoPais("BR")
                                    ->setIDType("03")
                                    ->setID("12345")
                            )
                            ->setApellidosNombreRazonSocial("Razón Social A S.L.")
                            ->setCodigoPostal("12345")
                            ->setDireccion("Avda. Nombre Avenida, 50"),
                        (new IDDestinatario())
                            ->setNIF("12345678A")
                            ->setApellidosNombreRazonSocial("Razón Social B S.L.")
                            ->setCodigoPostal("12345")
                            ->setDireccion("Avda. Nombre Avenida, 60")
                    ])
                    ->setVariosDestinatarios("S")
                    ->setEmitidaPorTercerosODestinatario("N")
            )
            ->setFactura(
                (new Factura())
                    ->setCabeceraFactura(
                        (new CabeceraFactura())
                            ->setSerieFactura("S-0001-00")
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
                                    ->setCantidad("1.0000")
                                    ->setImporteUnitario("1.0000")
                                    ->setImporteTotal("1.00"),
                                (new IDDetalleFactura())
                                    ->setDescripcionDetalle("Descripción del detalle de la línea de factura.")
                                    ->setCantidad("1.0000")
                                    ->setImporteUnitario("1.0000")
                                    ->setImporteTotal("1.00"),
                                (new IDDetalleFactura())
                                    ->setDescripcionDetalle("Descripción del detalle de la línea de factura.")
                                    ->setCantidad("1.0000")
                                    ->setImporteUnitario("1.0000")
                                    ->setImporteTotal("1.00")
                            ])
                            ->setImporteTotalFactura("3.00")
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
                                                    ->setBaseImponible("1.00"),
                                                (new DetalleExenta())
                                                    ->setCausaExencion("E2")
                                                    ->setBaseImponible("1.00")
                                            ])
                                            ->setNoExenta([
                                                (new DetalleNoExenta())
                                                    ->setTipoNoExenta("S1")
                                                    ->setDesgloseIVA([
                                                        (new DetalleIVA())->setBaseImponible("1.00"),
                                                        (new DetalleIVA())->setBaseImponible("1.00"),
                                                        (new DetalleIVA())->setBaseImponible("1.00")
                                                    ])
                                            ])
                                    )
                                    ->setNoSujeta([
                                        (new DetalleNoSujeta())
                                            ->setCausa("OT")
                                            ->setImporte("1.00"),
                                        (new DetalleNoSujeta())
                                            ->setCausa("RL")
                                            ->setImporte("1.00")
                                    ])
                            )
                    )
            )
            ->setHuellaTBAI(
                (new HuellaTBAI())
                    ->setEncadenamientoFacturaAnterior(
                        (new EncadenamientoFacturaAnterior())
                            ->setNumFacturaAnterior("0000")
                            ->setFechaExpedicionFacturaAnterior("01-01-2022")
                            ->setSignatureValueFirmaFacturaAnterior(\str_repeat("a", 100))
                    )
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
                    ->setNumSerieDispositivo("1122334455")
            );

        self::assertIsValid($ficheroAlta, null, ['Default', 'Gipuzkoa', 'Strict']);
    }

    public function testNotValidFicheroAlta(): void
    {
        $ficheroAlta = new FicheroAlta();

        self::assertIsNotValid($ficheroAlta);
    }
}