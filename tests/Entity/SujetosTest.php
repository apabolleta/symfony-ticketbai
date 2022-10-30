<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\Sujetos;
use APM\TicketBAIBundle\Entity\Emisor;
use APM\TicketBAIBundle\Entity\IDDestinatario;
use APM\TicketBAIBundle\Entity\IDOtro;

/**
 * Class to perform TicketBAI system 'Sujetos' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class SujetosTest extends TestEntity
{
    public function testValidSujetos(): void
    {
        $sujetos = new Sujetos();
        $sujetos
            ->setEmisor(
                (new Emisor())
                    ->setNIF("12345678A")
                    ->setApellidosNombreRazonSocial("Company Name S.L.")
            );

        self::assertIsValid($sujetos);

        $sujetos
            ->setDestinatarios([
                (new IDDestinatario())
                    ->setNIF("87654321Z")
                    ->setApellidosNombreRazonSocial("Cliente A")
                    ->setCodigoPostal("12345")
                    ->setDireccion("Dirección Cliente A"),
                (new IDDestinatario())
                    ->setIDOtro(
                        (new IDOtro())
                            ->setCodigoPais("BR")
                            ->setIDType("03")
                            ->setID("123456-AAA")
                    )
                    ->setApellidosNombreRazonSocial("Cliente B")
                    ->setCodigoPostal("12345")
                    ->setDireccion("Dirección Cliente B")
            ])
            ->setVariosDestinatarios("S")
            ->setEmitidaPorTercerosODestinatario("N");

        self::assertIsValid($sujetos);
    }

    public function testNotValidSujetos(): void
    {
        $sujetos = new Sujetos();

        self::assertIsNotValid($sujetos);

        $sujetos
            ->setEmisor(
                (new Emisor())
                    ->setNIF("")
            )
            ->setDestinatarios([
                (new IDDestinatario())
                    ->setNIF("87654321Z")
                    ->setApellidosNombreRazonSocial("Cliente A"),
                (new IDDestinatario())
                    ->setIDOtro(
                        (new IDOtro())
                            ->setCodigoPais("brr")
                            ->setIDType("03")
                            ->setID("123456-AAA")
                    )
                    ->setApellidosNombreRazonSocial("Cliente B")
            ])
            ->setVariosDestinatarios("s")
            ->setEmitidaPorTercerosODestinatario("n");

        self::assertCountConstraintViolations(7, $sujetos);
    }
}