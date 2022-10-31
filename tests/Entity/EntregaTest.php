<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\Entrega;
use APM\TicketBAIBundle\Entity\Sujeta;
use APM\TicketBAIBundle\Entity\DetalleNoSujeta;
use APM\TicketBAIBundle\Entity\DetalleExenta;
use APM\TicketBAIBundle\Entity\DetalleNoExenta;
use APM\TicketBAIBundle\Entity\DetalleIVA;

/**
 * Class to perform TicketBAI system 'Entrega' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class EntregaTest extends TestEntity
{
    public function testValidEntrega(): void
    {
        $entrega = new Entrega();

        self::assertIsValid($entrega);

        $entrega
            ->setSujeta(
                (new Sujeta())
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
                    ])
            )
            ->setNoSujeta([
                (new DetalleNoSujeta())
                    ->setCausa("OT")
                    ->setImporte("10000,00"),
                (new DetalleNoSujeta())
                    ->setCausa("RL")
                    ->setImporte("10000,00")
            ]);

        self::assertIsValid($entrega);
    }

    public function testNotValidEntrega(): void
    {
        $entrega = new Entrega();
        $entrega
            ->setSujeta(
                (new Sujeta())
                    ->setExenta([
                        (new DetalleExenta())
                            ->setCausaExencion("e1")
                            ->setBaseImponible("10000,00"),
                        (new DetalleExenta())
                            ->setCausaExencion("e2")
                            ->setBaseImponible("10000,00"),
                        (new DetalleExenta())
                            ->setCausaExencion("e3")
                            ->setBaseImponible("10000,00")
                    ])
                    ->setNoExenta([
                        (new DetalleNoExenta())
                            ->setTipoNoExenta("S1")
                            ->setDesgloseIVA([
                                (new DetalleIVA())->setBaseImponible("1,0000"),
                                (new DetalleIVA())->setBaseImponible("1,0000"),
                                (new DetalleIVA())->setBaseImponible("1,0000"),
                                (new DetalleIVA())->setBaseImponible("1,0000"),
                                (new DetalleIVA())->setBaseImponible("1,0000")
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
                    ])
            )
            ->setNoSujeta([
                (new DetalleNoSujeta())
                    ->setCausa("OT")
                    ->setImporte("10000.00"),
                (new DetalleNoSujeta())
                    ->setCausa("RL")
                    ->setImporte("10000.00")
            ]);

        self::assertCountConstraintViolations(10, $entrega);
    }
}