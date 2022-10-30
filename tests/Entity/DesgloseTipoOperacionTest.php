<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\DesgloseTipoOperacion;
use APM\TicketBAIBundle\Entity\PrestacionServicios;
use APM\TicketBAIBundle\Entity\Entrega;
use APM\TicketBAIBundle\Entity\Sujeta;
use APM\TicketBAIBundle\Entity\DetalleExenta;
use APM\TicketBAIBundle\Entity\DetalleNoExenta;
use APM\TicketBAIBundle\Entity\DetalleIVA;
use APM\TicketBAIBundle\Entity\DetalleNoSujeta;

/**
 * Class to perform TicketBAI system 'DesgloseTipoOperacion' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class DesgloseTipoOperacionTest extends TestEntity
{
    public function testValidDesgloseTipoOperacion(): void
    {
        $desgloseTipoOperacion = new DesgloseTipoOperacion();

        self::assertIsValid($desgloseTipoOperacion);

        $desgloseTipoOperacion
            ->setPrestacionServicios(
                (new PrestacionServicios())
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
                    ])
            )
            ->setEntrega(
                (new Entrega())
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
                    ])
            );

        self::assertIsValid($desgloseTipoOperacion);
    }

    public function testNotValidDesgloseTipoOperacion(): void
    {
        $desgloseTipoOperacion = new DesgloseTipoOperacion();
        $desgloseTipoOperacion
            ->setPrestacionServicios(
                (new PrestacionServicios())
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
                                    ])
                            ])
                    )
            )
            ->setEntrega(
                (new Entrega())
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
                            ->setImporte("10000,00"),
                        (new DetalleNoSujeta())
                            ->setImporte("10000,00")
                    ])
            );

        self::assertCountConstraintViolations(10, $desgloseTipoOperacion);
    }
}