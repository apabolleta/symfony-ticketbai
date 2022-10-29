<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\Sujeta;
use APM\TicketBAIBundle\Entity\DetalleExenta;
use APM\TicketBAIBundle\Entity\DetalleNoExenta;
use APM\TicketBAIBundle\Entity\DetalleIVA;

/**
 * Class to perform TicketBAI system 'Sujeta' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class SujetaTest extends TestEntity
{
    public function testValidSujeta(): void
    {
        $sujeta = new Sujeta();

        self::assertIsValid($sujeta);

        $sujeta
            ->setExenta([
                (new DetalleExenta())
                    ->setCausaExencion("E1")
                    ->setBaseImponible("10000,00"),
                (new DetalleExenta())
                    ->setCausaExencion("E2")
                    ->setBaseImponible("10000,00"),
                (new DetalleExenta())
                    ->setCausaExencion("E3")
                    ->setBaseImponible("10000,00")
            ])
            ->setNoExenta([
                (new DetalleNoExenta())
                    ->setTipoNoExenta("S1")
                    ->setDesgloseIVA([
                        (new DetalleIVA())->setBaseImponible("1,00"),
                        (new DetalleIVA())->setBaseImponible("1,00"),
                        (new DetalleIVA())->setBaseImponible("1,00"),
                        (new DetalleIVA())->setBaseImponible("1,00"),
                        (new DetalleIVA())->setBaseImponible("1,00")
                    ]),
                (new DetalleNoExenta())
                    ->setTipoNoExenta("S2")
                    ->setDesgloseIVA([
                        (new DetalleIVA())->setBaseImponible("1,00"),
                        (new DetalleIVA())->setBaseImponible("1,00"),
                        (new DetalleIVA())->setBaseImponible("1,00"),
                        (new DetalleIVA())->setBaseImponible("1,00"),
                        (new DetalleIVA())->setBaseImponible("1,00")
                    ])
            ]);

        self::assertIsValid($sujeta);
    }

    public function testNotValidSujeta(): void
    {
        $sujeta = new Sujeta();
        $sujeta
            ->setExenta([
                (new DetalleExenta()),
                (new DetalleExenta()),
                (new DetalleExenta())
            ])
            ->setNoExenta([
                (new DetalleNoExenta())
                    ->setTipoNoExenta("S01")
                    ->setDesgloseIVA([
                        (new DetalleIVA())
                            ->setBaseImponible("")
                    ])
            ]);

        self::assertCountConstraintViolations(9, $sujeta);
    }
}