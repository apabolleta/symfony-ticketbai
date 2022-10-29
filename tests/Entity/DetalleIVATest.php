<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\DetalleIVA;

/**
 * Class to perform TicketBAI system 'DetalleIVA' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class DetalleIVATest extends TestEntity
{
    public function testValidDetalleIVA(): void
    {
        $detalleIVA = new DetalleIVA();
        $detalleIVA
            ->setBaseImponible("10000,00");

        self::assertIsValid($detalleIVA);

        $detalleIVA
            ->setTipoImpositivo("123,45")
            ->setCuotaImpuesto("0,01")
            ->setTipoRecargoEquivalencia("123,45")
            ->setCuotaRecargoEquivalencia("0,01")
            ->setOperacionEnRecargoDeEquivalenciaORegimenSimplificado("S");

        self::assertIsValid($detalleIVA);
    }

    public function testNotValidDetalleIVA(): void
    {
        $detalleIVA = new DetalleIVA();

        self::assertIsNotValid($detalleIVA);

        $detalleIVA
            ->setTipoImpositivo("0,001")
            ->setCuotaImpuesto("-10,0")
            ->setTipoRecargoEquivalencia("10000,00")
            ->setCuotaRecargoEquivalencia("")
            ->setOperacionEnRecargoDeEquivalenciaORegimenSimplificado("s");

        self::assertCountConstraintViolations(6, $detalleIVA);
    }
}