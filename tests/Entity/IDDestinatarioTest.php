<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\IDDestinatario;
use APM\TicketBAIBundle\Entity\IDOtro;

/**
 * Class to perform TicketBAI system 'IDDestinatario' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class IDDestinatarioTest extends TestEntity
{
    public function testValidIDDestinatario(): void
    {
        $idDestinatario = new IDDestinatario();
        $idDestinatario
            ->setNIF("12345678A")
            ->setApellidosNombreRazonSocial("Pabolleta Martorell, Asier");

        self::assertIsValid($idDestinatario);

        $idOtro = new IDOtro();
        $idOtro
            ->setCodigoPais("BR")
            ->setIDType("04")
            ->setID("12345678A");

        $idDestinatario = new IDDestinatario();
        $idDestinatario
            ->setIDOtro($idOtro)
            ->setApellidosNombreRazonSocial("Company Name S.L.")
            ->setCodigoPostal("12345")
            ->setDireccion("C/ Calle, 5, 1º Izquierda");

        self::assertIsValid($idDestinatario);
    }

    public function testNotValidIDDestinatario(): void
    {
        $idDestinatario = new IDDestinatario();

        self::assertIsNotValid($idDestinatario);

        $idOtro = new IDOtro();
        $idOtro
            ->setCodigoPais("AAA")
            ->setIDType("04")
            ->setID("12345678A");

        $idDestinatario
            ->setNIF("12345678A")
            ->setIDOtro($idOtro)
            ->setApellidosNombreRazonSocial("Company Name S.L.");

        self::assertCountConstraintViolations(2, $idDestinatario);
    }
}