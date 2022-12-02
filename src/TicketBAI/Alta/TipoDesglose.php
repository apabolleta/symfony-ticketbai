<?php

namespace APM\TicketBAIBundle\TicketBAI\Alta;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\GroupSequenceProviderInterface;

use APM\TicketBAIBundle\StructureInterface;
use APM\TicketBAIBundle\TicketBAI\Alta\DesgloseFactura;
use APM\TicketBAIBundle\TicketBAI\Alta\DesgloseTipoOperacion;

/**
 * Class to define TicketBAI 'TipoDesglose' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 * @Assert\GroupSequenceProvider
 *
 */
class TipoDesglose implements StructureInterface, GroupSequenceProviderInterface
{
    /**
     * Cuando la contraparte es un “nacional” o no existe contraparte.
     *
     * Obligatorio:         Sí
     * Campo excluyente:    DesgloseTipoOperacion
     *
     * @access  private
     * @var     DesgloseFactura
     *
     * @Assert\IsNull(groups={"IsInternational"})
     * @Assert\NotNull(groups={"IsNational"})
     * @Assert\Type(type=DesgloseFactura::class)
     * @Assert\Valid
     */
    private DesgloseFactura $DesgloseFactura;

    /**
     * Cuando la contraparte es no nacional.
     *
     * Obligatorio:         Sí
     * Campo excluyente:    DesgloseFactura
     *
     * @access  private
     * @var     DesgloseTipoOperacion
     *
     * @Assert\IsNull(groups={"IsNational"})
     * @Assert\NotNull(groups={"IsInternational"})
     * @Assert\Type(type=DesgloseTipoOperacion::class)
     * @Assert\Valid
     */
    private DesgloseTipoOperacion $DesgloseTipoOperacion;

    public function getDesgloseFactura(): ?DesgloseFactura
    {
        return $this->DesgloseFactura;
    }

    public function setDesgloseFactura(DesgloseFactura $DesgloseFactura): self
    {
        $this->DesgloseFactura = $DesgloseFactura;

        return $this;
    }

    public function getDesgloseTipoOperacion(): ?DesgloseTipoOperacion
    {
        return $this->DesgloseTipoOperacion;
    }

    public function setDesgloseTipoOperacion(DesgloseTipoOperacion $DesgloseTipoOperacion): self
    {
        $this->DesgloseTipoOperacion = $DesgloseTipoOperacion;

        return $this;
    }

    public function getGroupSequence()
    {
        return [[
            'TipoDesglose',
            isset($this->DesgloseFactura) ? 'IsNational' : 'IsInternational'
        ]];
    }
}