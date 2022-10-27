<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\IDClave;

/**
 * Class to perform TicketBAI system 'IDClave' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class IDClaveTest extends TestEntity
{
    public function testValidIDClave(): void
    {
        $idClave = new IDClave();
        $idClave
            ->setClaveRegimenIVAOperacionTranscendencia("01");

        self::assertIsValid($idClave);

        $idClave
            ->setClaveRegimenIVAOperacionTranscendencia("51");

        self::assertIsValid($idClave);
    }

    public function testNotValidIDClave(): void
    {
        $idClave = new IDClave();

        self::assertIsNotValid($idClave);

        $idClave
            ->setClaveRegimenIVAOperacionTranscendencia("C01");

        self::assertCountConstraintViolations(2, $idClave);
    }
}