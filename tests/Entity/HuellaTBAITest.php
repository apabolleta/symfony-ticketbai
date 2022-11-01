<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\HuellaTBAI;
use APM\TicketBAIBundle\Entity\EncadenamientoFacturaAnterior;
use APM\TicketBAIBundle\Entity\SoftwareTicketBAI;
use APM\TicketBAIBundle\Entity\PersonaOEntidadDesarrolladora;

/**
 * Class to perform TicketBAI system 'HuellaTBAI' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class HuellaTBAITest extends TestEntity
{
    public function testValidHuellaTBAI(): void
    {
        $huellaTBAI = new HuellaTBAI();
        $huellaTBAI
            ->setSoftwareTicketBAI(
                (new SoftwareTicketBAI())
                    ->setLicenciaTBAI("1122334455")
                    ->setPersonaOEntidadDesarrolladora(
                        (new PersonaOEntidadDesarrolladora())
                            ->setNIF("12345678A")
                    )
                    ->setNombre("Symfony Bundle for TicketBAI system")
                    ->setVersion("0.0.1")
            );

        self::assertIsValid($huellaTBAI);

        $huellaTBAI
            ->setEncadenamientoFacturaAnterior(
                (new EncadenamientoFacturaAnterior())
                    ->setNumFacturaAnterior("0001")
                    ->setFechaExpedicionFacturaAnterior("01-01-2022")
                    ->setSignatureValueFirmaFacturaAnterior(\str_repeat("1", 100))
            )
            ->setNumSerieDispositivo("1122334455");

        self::assertIsValid($huellaTBAI);
    }

    public function testNotValidHuellaTBAI(): void
    {
        $huellaTBAI = new HuellaTBAI();

        self::assertIsNotValid($huellaTBAI);

        $huellaTBAI
            ->setEncadenamientoFacturaAnterior(
                (new EncadenamientoFacturaAnterior())
                    ->setSerieFacturaAnterior("S0001")
                    ->setNumFacturaAnterior("0001")
                    ->setFechaExpedicionFacturaAnterior("2022-1-1")
                    ->setSignatureValueFirmaFacturaAnterior(\str_repeat("1", 100))
            )
            ->setSoftwareTicketBAI(
                (new SoftwareTicketBAI())
                    ->setLicenciaTBAI("1122334455")
                    ->setPersonaOEntidadDesarrolladora(
                        (new PersonaOEntidadDesarrolladora())
                            ->setNIF("12345678A")
                    )
            )
            ->setNumSerieDispositivo("1122334455");

            self::assertCountConstraintViolations(4, $huellaTBAI);
    }
}