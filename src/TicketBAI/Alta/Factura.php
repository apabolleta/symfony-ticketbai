<?php

namespace APM\TicketBAIBundle\TicketBAI\Alta;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\TicketBAI\Alta\CabeceraFactura;
use APM\TicketBAIBundle\TicketBAI\Alta\DatosFactura;
use APM\TicketBAIBundle\TicketBAI\Alta\TipoDesglose;

/**
 * Class to define TicketBAI 'Factura' structure.
 *
 * @package  apabolleta/symfony-ticketbai
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