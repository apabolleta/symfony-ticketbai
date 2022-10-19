<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\IDOtro;

/**
 * Class to perform TicketBAI system 'IDOtro' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class IDOtroTest extends TestEntity
{
    public function testValidIDOtro(): void
    {
        $idOtro = new IDOtro();
        $idOtro
            ->setIDType("02")
            ->setID("1122334455ASDF");

        self::assertIsValid($idOtro);

        $idOtro = new IDOtro();
        $idOtro
            ->setCodigoPais("ES")
            ->setIDType("06")
            ->setID("ASDF7744-6");

        self::assertIsValid($idOtro);
    }

    public function testNotValidIDOtro(): void
    {
        $idOtro = new IDOtro();

        self::assertIsNotValid($idOtro);

        $idOtro
            ->setCodigoPais("ASD12")
            ->setIDType("000");

        self::assertCountConstraintViolations(5, $idOtro);
    }
}