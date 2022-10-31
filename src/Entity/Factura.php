<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\Entity\CabeceraFactura;
use APM\TicketBAIBundle\Entity\DatosFactura;
use APM\TicketBAIBundle\Entity\TipoDesglose;

/**
 * Class to define TicketBAI system 'Factura' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class Factura
{
    /**
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     CabeceraFactura
     *
     * @Assert\NotNull
     * @Assert\Type(type=CabeceraFactura::class)
     * @Assert\Valid
     */
    private CabeceraFactura $CabeceraFactura;

    /**
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     DatosFactura
     *
     * @Assert\NotNull
     * @Assert\Type(type=DatosFactura::class)
     * @Assert\Valid
     */
    private DatosFactura $DatosFactura;

    /**
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     TipoDesglose
     *
     * @Assert\NotNull
     * @Assert\Type(type=TipoDesglose::class)
     * @Assert\Valid
     */
    private TipoDesglose $TipoDesglose;

    public function getCabeceraFactura(): CabeceraFactura
    {
        return $this->CabeceraFactura;
    }

    public function setCabeceraFactura(CabeceraFactura $CabeceraFactura): self
    {
        $this->CabeceraFactura = $CabeceraFactura;

        return $this;
    }

    public function getDatosFactura(): DatosFactura
    {
        return $this->DatosFactura;
    }

    public function setDatosFactura(DatosFactura $DatosFactura): self
    {
        $this->DatosFactura = $DatosFactura;

        return $this;
    }

    public function getTipoDesglose(): TipoDesglose
    {
        return $this->TipoDesglose;
    }

    public function setTipoDesglose(TipoDesglose $TipoDesglose): self
    {
        $this->TipoDesglose = $TipoDesglose;

        return $this;
    }
}