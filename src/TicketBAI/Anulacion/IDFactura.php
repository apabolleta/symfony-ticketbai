<?php

namespace APM\TicketBAIBundle\TicketBAI\Anulacion;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\StructureInterface;
use APM\TicketBAIBundle\TicketBAI\Anulacion\Emisor;
use APM\TicketBAIBundle\TicketBAI\Anulacion\CabeceraFactura;

/**
 * Class to define TicketBAI 'IDFactura' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class IDFactura implements StructureInterface
{
    /**
     * Obligatorio:         Sí
     *
     * @access  private
     * @var     Emisor
     *
     * @Assert\NotNull
     * @Assert\Type(type=Emisor::class)
     * @Assert\Valid
     */
    private Emisor $Emisor;

    /**
     * Obligatorio:         Sí
     *
     * @access  private
     * @var     CabeceraFactura
     *
     * @Assert\NotNull
     * @Assert\Type(type=CabeceraFactura::class)
     * @Assert\Valid
     */
    private CabeceraFactura $CabeceraFactura;

    public function getEmisor(): Emisor
    {
        return $this->Emisor;
    }

    public function setEmisor(Emisor $Emisor): self
    {
        $this->Emisor = $Emisor;

        return $this;
    }

    public function getCabeceraFactura(): CabeceraFactura
    {
        return $this->CabeceraFactura;
    }

    public function setCabeceraFactura(CabeceraFactura $CabeceraFactura): self
    {
        $this->CabeceraFactura = $CabeceraFactura;

        return $this;
    }
}