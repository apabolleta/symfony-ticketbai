<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\IDFacturaRectificadaSustituida;

/**
 * Class to perform TicketBAI system 'IDFacturaRectificadaSustituida' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class IDFacturaRectificadaSustituidaTest extends TestEntity
{
    public function testValidIDFacturaRectificadaSustituida(): void
    {
        $idFacturaRectificadaSustituida = new IDFacturaRectificadaSustituida();
        $idFacturaRectificadaSustituida
            ->setNumFactura("0001")
            ->setFechaExpedicionFactura("01-01-2022");

        self::assertIsValid($idFacturaRectificadaSustituida);

        $idFacturaRectificadaSustituida
            ->setSerieFactura("S-0001");

        self::assertIsValid($idFacturaRectificadaSustituida);
    }

    public function testNotValidIDFacturaRectificadaSustituida(): void
    {
        $idFacturaRectificadaSustituida = new IDFacturaRectificadaSustituida();

        self::assertIsNotValid($idFacturaRectificadaSustituida);

        $idFacturaRectificadaSustituida
            ->setSerieFactura("SI-0001")
            ->setNumFactura("N12345")
            ->setFechaExpedicionFactura("2022-1-1");

        self::assertCountConstraintViolations(4, $idFacturaRectificadaSustituida, null, ["IDFacturaRectificadaSustituida", "strict"]);
    }
}