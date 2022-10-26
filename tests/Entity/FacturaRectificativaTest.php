<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\FacturaRectificativa;
use APM\TicketBAIBundle\Entity\ImporteRectificacionSustitutiva;

/**
 * Class to perform TicketBAI system 'FacturaRectificativa' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class FacturaRectificativaTest extends TestEntity
{
    public function testValidFacturaRectificativa(): void
    {
        $facturaRectificativa = new FacturaRectificativa();
        $facturaRectificativa
            ->setCodigo("R1")
            ->setTipo("S");

        self::assertIsValid($facturaRectificativa);

        $importeRectificacionSustitutiva = new ImporteRectificacionSustitutiva();
        $importeRectificacionSustitutiva
            ->setBaseRectificada("12,12")
            ->setCuotaRectificada("0,95")
            ->setCuotaRecargoRectificada("12345");

        $facturaRectificativa
            ->setImporteRectificacionSustitutiva($importeRectificacionSustitutiva);

        self::assertIsValid($facturaRectificativa);
    }

    public function testNotValidFacturaRectificativa(): void
    {
        $facturaRectificativa = new FacturaRectificativa();

        self::assertIsNotValid($facturaRectificativa);

        $facturaRectificativa
            ->setCodigo("R0")
            ->setImporteRectificacionSustitutiva(new ImporteRectificacionSustitutiva);

        self::assertCountConstraintViolations(4, $facturaRectificativa);
    }
}