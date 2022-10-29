<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\DetalleNoSujeta;

/**
 * Class to perform TicketBAI system 'DetalleNoSujeta' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class DetalleNoSujetaTest extends TestEntity
{
    public function testValidDetalleNoSujeta(): void
    {
        $detalleNoSujeta = new DetalleNoSujeta();
        $detalleNoSujeta
            ->setCausa("RL")
            ->setImporte("10000,00");

        self::assertIsValid($detalleNoSujeta);
    }

    public function testNotValidDetalleNoSujeta(): void
    {
        $detalleNoSujeta = new DetalleNoSujeta();

        self::assertIsNotValid($detalleNoSujeta);

        $detalleNoSujeta
            ->setCausa("Rl")
            ->setImporte("0,001");

        self::assertCountConstraintViolations(2, $detalleNoSujeta);
    }
}