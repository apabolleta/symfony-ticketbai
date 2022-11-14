<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\TicketBAI\Alta;

use APM\TicketBAIBundle\Tests\EntityValidationTestCase;
use APM\TicketBAIBundle\TicketBAI\Alta\FicheroAlta;
use APM\TicketBAIBundle\TicketBAI\Alta\Cabecera;
use APM\TicketBAIBundle\TicketBAI\Alta\Sujetos;
use APM\TicketBAIBundle\TicketBAI\Alta\Emisor;
use APM\TicketBAIBundle\TicketBAI\Alta\IDDestinatario;
use APM\TicketBAIBundle\TicketBAI\Alta\IDOtro;
use APM\TicketBAIBundle\TicketBAI\Alta\Factura;
use APM\TicketBAIBundle\TicketBAI\Alta\CabeceraFactura;
use APM\TicketBAIBundle\TicketBAI\Alta\FacturaRectificativa;
use APM\TicketBAIBundle\TicketBAI\Alta\ImporteRectificacionSustitutiva;
use APM\TicketBAIBundle\TicketBAI\Alta\IDFacturaRectificadaSustituida;
use APM\TicketBAIBundle\TicketBAI\Alta\DatosFactura;
use APM\TicketBAIBundle\TicketBAI\Alta\IDDetalleFactura;
use APM\TicketBAIBundle\TicketBAI\Alta\IDClave;
use APM\TicketBAIBundle\TicketBAI\Alta\TipoDesglose;
use APM\TicketBAIBundle\TicketBAI\Alta\DesgloseFactura;
use APM\TicketBAIBundle\TicketBAI\Alta\Sujeta;
use APM\TicketBAIBundle\TicketBAI\Alta\DetalleExenta;
use APM\TicketBAIBundle\TicketBAI\Alta\DetalleNoExenta;
use APM\TicketBAIBundle\TicketBAI\Alta\DetalleIVA;
use APM\TicketBAIBundle\TicketBAI\Alta\DetalleNoSujeta;
use APM\TicketBAIBundle\TicketBAI\Alta\DesgloseTipoOperacion;
use APM\TicketBAIBundle\TicketBAI\Alta\PrestacionServicios;
use APM\TicketBAIBundle\TicketBAI\Alta\Entrega;
use APM\TicketBAIBundle\TicketBAI\Alta\HuellaTBAI;
use APM\TicketBAIBundle\TicketBAI\Alta\EncadenamientoFacturaAnterior;
use APM\TicketBAIBundle\TicketBAI\Alta\SoftwareTicketBAI;
use APM\TicketBAIBundle\TicketBAI\Alta\PersonaOEntidadDesarrolladora;

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

        $ficheroAlta
            ->setCabecera(
                (new Cabecera())
                    ->setIDVersionTBAI("v10.20.1")  # 1.- Invalid length (max length: 5, current: 8)
                                                    # 2.- Invalid choice
            )
            ->setSujetos(
                (new Sujetos())
                    ->setEmisor(
                        (new Emisor())
                            ->setNIF("12345678")  # 3.- Invalid length (length: 9, current: 8)
                                                  # 4.- Invalid format (letter missing)
                            ->setApellidosNombreRazonSocial("")  # 5.- Not blank
                    )
                    ->setDestinatarios([
                        (new IDDestinatario())
                            ->setNIF("12345678a")  # 6.- Mutually exclusive: NIF-IDOtro
                            ->setIDOtro(
                                (new IDOtro())
                                    ->setCodigoPais("BR")
                                    ->setIDType("02")
                                    ->setID("1122334455")
                            )
                            ->setApellidosNombreRazonSocial("Apellidos, Nombre")
                            ->setCodigoPostal("12345")
                            ->setDireccion("Avda. Nombre Avenida, 50"),
                        (new IDDestinatario())
                            ->setIDOtro(
                                (new IDOtro())
                                    ->setCodigoPais("BRR")  # 7.- Invalid length (length: 2, current: 3)
                                                            # 8.- Invalid country code
                                    ->setIDType("AA")  # 9.- Invalid choice
                                    ->setID("")  # 10.- Not blank
                            )
                            ->setApellidosNombreRazonSocial("Apellidos, Nombre"),
                            # 11.- Undefined CodigoPostal (mandatory for 'Gipuzkoa')
                            # 12.- Undefined Direccion (mandatory for 'Gipuzkoa')
                    ])
                    ->setVariosDestinatarios("s")  # 13.- Invalid choice (case sensitive)
                    ->setEmitidaPorTercerosODestinatario("N")
            )
            ->setFactura(
                (new Factura())
                    ->setCabeceraFactura(
                        (new CabeceraFactura())
                            ->setSerieFactura("s.0000.00")  # 14.- Invalid format in 'Strict' mode
                            ->setNumFactura("n0001")  # 15.- Invalid format in 'Strict' mode
                            ->setFechaExpedicionFactura("2022-01-01")  # 16.- Invalid date format
                            ->setHoraExpedicionFactura("10:00:00.00")  # 17.- Invalid length (length: 8, current: 11)
                                                                       # 18.- Invalid time format
                            ->setFacturaSimplificada("N")
                            ->setFacturaEmitidaSustitucionSimplificada("N")
                            ->setFacturaRectificativa(
                                (new FacturaRectificativa())
                                    ->setCodigo("R1")
                                    ->setTipo("I")
                                    ->setImporteRectificacionSustitutiva(
                                        (new ImporteRectificacionSustitutiva())
                                            ->setBaseRectificada("10000.0000")  # 19.- Invalid number format (decimals: 2, current: 4)
                                            ->setCuotaRectificada("10000,0000")  # 20.- Invalid number format (decimal separator: '.', current: ',')
                                            ->setCuotaRecargoRectificada("1.00")
                                    )
                            )
                            ->setFacturasRectificadasSustituidas([
                                (new IDFacturaRectificadaSustituida())
                                    ->setSerieFactura("S0000-00")
                                    ->setNumFactura("0000")
                                    ->setFechaExpedicionFactura("01/01/2022"),  # 21.- Invalid date format (character '/' not allowed)
                                (new IDFacturaRectificadaSustituida())
                                    ->setSerieFactura("S0000-01")
                                    ->setNumFactura("0000")
                                    ->setFechaExpedicionFactura("01-01-2022"),
                                (new IDFacturaRectificadaSustituida())
                                    ->setSerieFactura("S0000-02")
                                    ->setNumFactura("0000")
                                    ->setFechaExpedicionFactura("01-01-2022"),
                            ])
                    )
                    ->setDatosFactura(
                        (new DatosFactura())
                            ->setDescripcionFactura("Descripción general de las operaciones.")
                            ->setDetallesFactura([
                                "Detalle 1",  # 22.- Invalid type (type: IDDetalleFactura, current: string)
                                "Detalle 2",  # 23.- Invalid type (type: IDDetalleFactura, current: string)
                                "Detalle 3",  # 24.- Invalid type (type: IDDetalleFactura, current: string)
                                "Detalle 4",  # 25.- Invalid type (type: IDDetalleFactura, current: string)
                                "Detalle 5",  # 26.- Invalid type (type: IDDetalleFactura, current: string)
                            ])
                            ->setImporteTotalFactura("3.00")
                            ->setRetencionSoportada("1.00")
                            ->setBaseImponibleACoste("1.00")
                            ->setClaves([  # 27.- Invalid array count (count: 1-3, current: 5)
                                (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("01"),
                                (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("01"),
                                (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("01"),
                                (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("01"),
                                (new IDClave())->setClaveRegimenIVAOperacionTranscendencia("01"),
                            ])
                    )
                    ->setTipoDesglose(
                        (new TipoDesglose())
                            ->setDesgloseFactura(  # 28.- Mutually exclusive: DesgloseFactura-DesgloseTipoOperacion
                                (new DesgloseFactura())
                                    ->setSujeta(
                                        (new Sujeta())
                                            ->setExenta([
                                                (new DetalleExenta())
                                                    ->setCausaExencion("E1")
                                                    ->setBaseImponible("1.00"),
                                                (new DetalleExenta())
                                                    ->setCausaExencion("E2")
                                                    ->setBaseImponible("1.00"),
                                                (new DetalleExenta())
                                                    # 29.- Undefined CausaExencion
                                                    ->setBaseImponible("1.00"),
                                            ])
                                            ->setNoExenta([
                                                (new DetalleNoExenta())
                                                    ->setTipoNoExenta("S1")
                                                    ->setDesgloseIVA([
                                                        (new DetalleIVA())
                                                            ->setBaseImponible("1.00")
                                                            ->setTipoImpositivo("1.00")
                                                            ->setCuotaImpuesto("1.00")
                                                            ->setTipoRecargoEquivalencia("1.00")
                                                            ->setCuotaRecargoEquivalencia("1.00")
                                                            ->setOperacionEnRecargoDeEquivalenciaORegimenSimplificado("N"),
                                                        (new DetalleIVA())
                                                            ->setBaseImponible("1.00")
                                                            ->setTipoImpositivo("1.00")
                                                            ->setCuotaImpuesto("1.00")
                                                            ->setTipoRecargoEquivalencia("1.00")
                                                            ->setCuotaRecargoEquivalencia("1.00")
                                                            ->setOperacionEnRecargoDeEquivalenciaORegimenSimplificado("S")
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
                            ->setDesgloseTipoOperacion(
                                (new DesgloseTipoOperacion())
                                    ->setPrestacionServicios(
                                        (new PrestacionServicios())
                                            ->setSujeta(
                                                (new Sujeta())
                                                    ->setExenta([
                                                        (new DetalleExenta())
                                                            ->setCausaExencion("E5")
                                                            ->setBaseImponible("1.00"),
                                                        (new DetalleExenta())
                                                            ->setCausaExencion("E6")
                                                            ->setBaseImponible("1.00")
                                                    ])
                                            )
                                    )
                                    ->setEntrega(
                                        (new Entrega())
                                            ->setNoSujeta([
                                                (new DetalleNoSujeta)
                                                    ->setCausa("ot")  # 30.- Invalid choice (case sensitive)
                                                    ->setImporte("1.0000")  # 31.- Invalid number format (decimals: 2, current: 4)
                                            ])
                                    )
                            )
                    )
            )
            ->setHuellaTBAI(
                (new HuellaTBAI())
                    ->setEncadenamientoFacturaAnterior(
                        (new EncadenamientoFacturaAnterior())
                            ->setSerieFacturaAnterior("S0000-0000.01")  # 32.- Invalid format in 'Strict' mode
                            ->setNumFacturaAnterior("12345")
                            ->setFechaExpedicionFacturaAnterior("01 01 2022")  # 33.- Invalid date format (separator: '-')
                            ->setSignatureValueFirmaFacturaAnterior(\str_repeat("1", 100))
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
            );

        self::assertCountConstraintViolations(33, $ficheroAlta, null, ['Default', 'Gipuzkoa', 'Strict']);
    }
}