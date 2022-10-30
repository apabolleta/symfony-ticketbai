<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\CabeceraFactura;
use APM\TicketBAIBundle\Entity\FacturaRectificativa;
use APM\TicketBAIBundle\Entity\ImporteRectificacionSustitutiva;
use APM\TicketBAIBundle\Entity\IDFacturaRectificadaSustituida;

/**
 * Class to perform TicketBAI system 'CabeceraFactura' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class CabeceraFacturaTest extends TestEntity
{
    public function testValidCabeceraFactura(): void
    {
        $cabeceraFactura = new CabeceraFactura();
        $cabeceraFactura
            ->setNumFactura("0001")
            ->setFechaExpedicionFactura("01-01-2022")
            ->setHoraExpedicionFactura("10:10:00");

        self::assertIsValid($cabeceraFactura);

        $cabeceraFactura
            ->setSerieFactura("S0001")
            ->setFacturaSimplificada("S")
            ->setFacturaEmitidaSustitucionSimplificada("N")
            ->setFacturaRectificativa(
                (new FacturaRectificativa())
                    ->setCodigo("R1")
                    ->setTipo("S")
                    ->setImporteRectificacionSustitutiva(
                        (new ImporteRectificacionSustitutiva())
                            ->setBaseRectificada("1,00")
                            ->setCuotaRectificada("1,00")
                            ->setCuotaRecargoRectificada("0,01")
                    )
            )
            ->setFacturasRectificadasSustituidas([
                (new IDFacturaRectificadaSustituida())
                    ->setSerieFactura("S0001")
                    ->setNumFactura("0001")
                    ->setFechaExpedicionFactura("01-01-2022"),
                (new IDFacturaRectificadaSustituida())
                    ->setSerieFactura("S0001")
                    ->setNumFactura("0002")
                    ->setFechaExpedicionFactura("01-01-2022"),
            ]);

        self::assertIsValid($cabeceraFactura);
    }

    public function testNotValidCabeceraFactura(): void
    {
        $cabeceraFactura = new CabeceraFactura();

        self::assertIsNotValid($cabeceraFactura);

        $cabeceraFactura
            ->setSerieFactura("S0001")
            ->setNumFactura("0001")
            ->setFechaExpedicionFactura("2022-01-01")
            ->setHoraExpedicionFactura("10:10:0000")
            ->setFacturaSimplificada("s")
            ->setFacturaEmitidaSustitucionSimplificada("n")
            ->setFacturaRectificativa(
                (new FacturaRectificativa())
                    ->setCodigo("")
                    ->setTipo("")
                    ->setImporteRectificacionSustitutiva(
                        (new ImporteRectificacionSustitutiva())
                            ->setBaseRectificada("1,0000")
                            ->setCuotaRectificada("1,0000")
                            ->setCuotaRecargoRectificada("0,0100")
                    )
            )
            ->setFacturasRectificadasSustituidas([]);

        self::assertCountConstraintViolations(15, $cabeceraFactura);
    }
}