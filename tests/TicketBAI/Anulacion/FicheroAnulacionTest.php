<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\TicketBAI\Anulacion;

use APM\TicketBAIBundle\Tests\EntityValidationTestCase;
use APM\TicketBAIBundle\TicketBAI\Anulacion\FicheroAnulacion;
use APM\TicketBAIBundle\TicketBAI\Anulacion\Cabecera;
use APM\TicketBAIBundle\TicketBAI\Anulacion\IDFactura;
use APM\TicketBAIBundle\TicketBAI\Anulacion\Emisor;
use APM\TicketBAIBundle\TicketBAI\Anulacion\CabeceraFactura;
use APM\TicketBAIBundle\TicketBAI\Anulacion\HuellaTBAI;
use APM\TicketBAIBundle\TicketBAI\Anulacion\SoftwareTicketBAI;
use APM\TicketBAIBundle\TicketBAI\Anulacion\PersonaOEntidadDesarrolladora;
use APM\TicketBAIBundle\TicketBAI\Anulacion\IDOtro;

/**
 * Class to perform TicketBAI 'FicheroAnulacion' structure validation tests.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class FicheroAnulacionTest extends EntityValidationTestCase
{
    public function testValidFicheroAnulacion(): void
    {
        $ficheroAnulacion = new FicheroAnulacion();
        $ficheroAnulacion
            ->setCabecera(
                (new Cabecera())
                    ->setIDVersionTBAI("1.2")
            )
            ->setIDFactura(
                (new IDFactura())
                    ->setEmisor(
                        (new Emisor())
                            ->setNIF("12345678A")
                            ->setApellidosNombreRazonSocial("Apellidos, Nombre")
                    )
                    ->setCabeceraFactura(
                        (new CabeceraFactura())
                            ->setNumFactura("12345")
                            ->setFechaExpedicionFactura("01-01-2022")
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

        self::assertIsValid($ficheroAnulacion);

        $ficheroAnulacion = new FicheroAnulacion();
        $ficheroAnulacion
            ->setCabecera(
                (new Cabecera())
                    ->setIDVersionTBAI("1.2")
            )
            ->setIDFactura(
                (new IDFactura())
                    ->setEmisor(
                        (new Emisor())
                            ->setNIF("12345678A")
                            ->setApellidosNombreRazonSocial("Apellidos, Nombre")
                    )
                    ->setCabeceraFactura(
                        (new CabeceraFactura())
                            ->setSerieFactura("S0001-01")
                            ->setNumFactura("12345")
                            ->setFechaExpedicionFactura("01-01-2022")
                    )
            )
            ->setHuellaTBAI(
                (new HuellaTBAI())
                    ->setSoftwareTicketBAI(
                        (new SoftwareTicketBAI())
                            ->setLicenciaTBAI("1122334455")
                            ->setPersonaOEntidadDesarrolladora(
                                (new PersonaOEntidadDesarrolladora())
                                    ->setIDOtro(
                                        (new IDOtro())
                                            ->setCodigoPais("BR")
                                            ->setIDType("03")
                                            ->setID("1122334455")
                                    )
                            )
                            ->setNombre("apabolleta/symfony-ticketbai")
                            ->setVersion("0.0.1")
                    )
                    ->setNumSerieDispositivo("12345")
            );

        self::assertIsValid($ficheroAnulacion);
    }

    public function testNotValidFicheroAnulacion(): void
    {
        $ficheroAnulacion = new FicheroAnulacion();

        self::assertIsNotValid($ficheroAnulacion);

        $ficheroAnulacion
            ->setCabecera(
                (new Cabecera())
                    ->setIDVersionTBAI("v1.2")  # 1.- Invalid choice
            )
            ->setIDFactura(
                (new IDFactura())
                    ->setEmisor(
                        (new Emisor())
                            ->setNIF("")  # 2.- Not blank
                                          # 3.- Invalid length (length: 9, current: 0)
                            ->setApellidosNombreRazonSocial("")  # 4.- Not blank
                    )
                    ->setCabeceraFactura(
                        (new CabeceraFactura())
                            ->setSerieFactura("S0001-01-xyz")  # 5.- Invalid format in 'Strict' mode
                            ->setNumFactura("12345abc")  # 6.- Invalid format in 'Strict' mode
                            # 7.- Undefined FechaExpedicionFactura
                    )
            )
            ->setHuellaTBAI(
                (new HuellaTBAI())
                    ->setSoftwareTicketBAI(
                        (new SoftwareTicketBAI())
                            ->setLicenciaTBAI("1122334455")
                            # 8.- Undefined PersonaOEntidadDesarrolladora
                            ->setNombre("")  # 9.- Not blank
                            ->setVersion("")  # 10.- Not blank
                    )
            );

        self::assertCountConstraintViolations(10, $ficheroAnulacion, null, ['Default', 'Strict']);
    }
}