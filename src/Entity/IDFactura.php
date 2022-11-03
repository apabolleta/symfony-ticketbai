<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\Entity\Emisor;
use APM\TicketBAIBundle\Entity\CabeceraFactura;

/**
 * Class to define TicketBAI system 'IDFactura' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class IDFactura
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