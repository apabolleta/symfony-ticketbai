<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\SoftwareTicketBAI;
use APM\TicketBAIBundle\Entity\PersonaOEntidadDesarrolladora;

/**
 * Class to perform TicketBAI system 'SoftwareTicketBAI' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class SoftwareTicketBAITest extends TestEntity
{
    public function testValidSoftwareTicketBAI(): void
    {
        $softwareTicketBAI = new SoftwareTicketBAI();
        $softwareTicketBAI
            ->setLicenciaTBAI("1122334455")
            ->setPersonaOEntidadDesarrolladora(
                (new PersonaOEntidadDesarrolladora())
                    ->setNIF("12345678A")
            )
            ->setNombre("Symfony Bundle for TicketBAI system")
            ->setVersion("0.0.1");

        self::assertIsValid($softwareTicketBAI);
    }

    public function testNotValidSoftwareTicketBAI(): void
    {
        $softwareTicketBAI = new SoftwareTicketBAI();

        self::assertIsNotValid($softwareTicketBAI);

        $softwareTicketBAI
            ->setLicenciaTBAI("")
            ->setPersonaOEntidadDesarrolladora(new PersonaOEntidadDesarrolladora())
            ->setNombre("Symfony Bundle for TicketBAI system")
            ->setVersion("0.0.1");

        self::assertCountConstraintViolations(2, $softwareTicketBAI);
    }
}