<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\Entity\PrestacionServicios;
use APM\TicketBAIBundle\Entity\Entrega;

/**
 * Class to define TicketBAI 'DesgloseTipoOperacion' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class DesgloseTipoOperacion
{
    /**
     * Obligatorio:         No
     *
     * @access  private
     * @var     PrestacionServicios
     *
     * @Assert\Type(type=PrestacionServicios::class)
     * @Assert\Valid
     */
    private PrestacionServicios $PrestacionServicios;

    /**
     * Obligatorio:         No
     *
     * @access  private
     * @var     Entrega
     *
     * @Assert\Type(type=Entrega::class)
     * @Assert\Valid
     */
    private Entrega $Entrega;

    public function getPrestacionServicios(): ?PrestacionServicios
    {
        return $this->PrestacionServicios;
    }

    public function setPrestacionServicios(PrestacionServicios $PrestacionServicios): self
    {
        $this->PrestacionServicios = $PrestacionServicios;

        return $this;
    }

    public function getEntrega(): ?Entrega
    {
        return $this->Entrega;
    }

    public function setEntrega(Entrega $Entrega): self
    {
        $this->Entrega = $Entrega;

        return $this;
    }
}