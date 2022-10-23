<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\ImporteRectificacionSustitutiva;

/**
 * Class to perform TicketBAI system 'ImporteRectificacionSustitutiva' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class ImporteRectificacionSustitutivaTest extends TestEntity
{
    public function testValidImporteRectificacionSustitutiva(): void
    {
        $importeRectificacionSustitutiva = new ImporteRectificacionSustitutiva();
        $importeRectificacionSustitutiva
            ->setBaseRectificada("12,12")
            ->setCuotaRectificada("0,95");

        self::assertIsValid($importeRectificacionSustitutiva);

        $importeRectificacionSustitutiva
            ->setCuotaRecargoRectificada("12345");

        self::assertIsValid($importeRectificacionSustitutiva);
    }

    public function testNotValidImporteRectificacionSustitutiva(): void
    {
        $importeRectificacionSustitutiva = new ImporteRectificacionSustitutiva();

        self::assertIsNotValid($importeRectificacionSustitutiva);

        $importeRectificacionSustitutiva
            ->setBaseRectificada("12,345")
            ->setCuotaRectificada("12.3");

        self::assertCountConstraintViolations(2, $importeRectificacionSustitutiva);
    }
}