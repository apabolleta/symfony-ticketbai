<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\PersonaOEntidadDesarrolladora;
use APM\TicketBAIBundle\Entity\IDOtro;

/**
 * Class to perform TicketBAI system 'PersonaOEntidadDesarrolladora' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class PersonaOEntidadDesarrolladoraTest extends TestEntity
{
    public function testValidPersonaOEntidadDesarrolladora(): void
    {
        $personaOEntidadDesarrolladora = new PersonaOEntidadDesarrolladora();
        $personaOEntidadDesarrolladora
            ->setNIF("12345678A");

        self::assertIsValid($personaOEntidadDesarrolladora);

        $personaOEntidadDesarrolladora = new PersonaOEntidadDesarrolladora();
        $personaOEntidadDesarrolladora
            ->setIDOtro(
                (new IDOtro())
                    ->setCodigoPais("BR")
                    ->setIDType("04")
                    ->setID("123456789")
            );

        self::assertIsValid($personaOEntidadDesarrolladora);
    }

    public function testNotValidPersonaOEntidadDesarrolladora(): void
    {
        $personaOEntidadDesarrolladora = new PersonaOEntidadDesarrolladora();

        self::assertIsNotValid($personaOEntidadDesarrolladora);

        $personaOEntidadDesarrolladora
            ->setNIF("12345678A")
            ->setIDOtro(
                (new IDOtro())
                    ->setIDType("02")
                    ->setID("1122334455")
            );

        self::assertCountConstraintViolations(1, $personaOEntidadDesarrolladora);
    }
}