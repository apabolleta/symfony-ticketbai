<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\EncadenamientoFacturaAnterior;

/**
 * Class to perform TicketBAI system 'EncadenamientoFacturaAnterior' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class EncadenamientoFacturaAnteriorTest extends TestEntity
{
    public function testValidEncadenamientoFacturaAnterior(): void
    {
        $encadenamientoFacturaAnterior = new EncadenamientoFacturaAnterior();
        $encadenamientoFacturaAnterior
            ->setNumFacturaAnterior("0001")
            ->setFechaExpedicionFacturaAnterior("01-01-2022")
            ->setSignatureValueFirmaFacturaAnterior(\str_repeat("1", 100));

        self::assertIsValid($encadenamientoFacturaAnterior);

        $encadenamientoFacturaAnterior
            ->setSerieFacturaAnterior("S0001");

        self::assertIsValid($encadenamientoFacturaAnterior);
    }

    public function testNotValidEncadenamientoFacturaAnterior(): void
    {
        $encadenamientoFacturaAnterior = new EncadenamientoFacturaAnterior();

        self::assertIsNotValid($encadenamientoFacturaAnterior);

        $encadenamientoFacturaAnterior
            ->setSerieFacturaAnterior("S0001")
            ->setNumFacturaAnterior("0001")
            ->setFechaExpedicionFacturaAnterior("2022-1-1")
            ->setSignatureValueFirmaFacturaAnterior(\str_repeat("1", 50));

        self::assertCountConstraintViolations(3, $encadenamientoFacturaAnterior);
    }
}