<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\Entity;

use APM\TicketBAIBundle\Tests\Entity\TestEntity;
use APM\TicketBAIBundle\Entity\TipoDesglose;
use APM\TicketBAIBundle\Entity\DesgloseFactura;
use APM\TicketBAIBundle\Entity\DesgloseTipoOperacion;
use APM\TicketBAIBundle\Entity\Sujeta;
use APM\TicketBAIBundle\Entity\DetalleExenta;
use APM\TicketBAIBundle\Entity\DetalleNoExenta;
use APM\TicketBAIBundle\Entity\DetalleIVA;
use APM\TicketBAIBundle\Entity\DetalleNoSujeta;

/**
 * Class to perform TicketBAI system 'TipoDesglose' structure tests.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class TipoDesgloseTest extends TestEntity
{
    public function testValidTipoDesglose(): void
    {
        $tipoDesglose = new TipoDesglose();
        $tipoDesglose
            ->setDesgloseFactura(
                (new DesgloseFactura())
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

        self::assertIsValid($tipoDesglose);
    }

    public function testNotValidTipoDesglose(): void
    {
        $tipoDesglose = new TipoDesglose();

        self::assertIsNotValid($tipoDesglose);

        $tipoDesglose
            ->setDesgloseFactura(
                (new DesgloseFactura())
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
            ->setDesgloseTipoOperacion(new DesgloseTipoOperacion());

        self::assertCountConstraintViolations(1, $tipoDesglose);
    }
}