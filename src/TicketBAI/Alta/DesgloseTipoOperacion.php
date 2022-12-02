<?php

namespace APM\TicketBAIBundle\TicketBAI\Alta;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\StructureInterface;
use APM\TicketBAIBundle\TicketBAI\Alta\PrestacionServicios;
use APM\TicketBAIBundle\TicketBAI\Alta\Entrega;

/**
 * Class to define TicketBAI 'DesgloseTipoOperacion' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class DesgloseTipoOperacion implements StructureInterface
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

    public function getPrestacionServicios(): PrestacionServicios
    {
        return $this->PrestacionServicios;
    }

    public function setPrestacionServicios(PrestacionServicios $PrestacionServicios): self
    {
        $this->PrestacionServicios = $PrestacionServicios;

        return $this;
    }

    public function getEntrega(): Entrega
    {
        return $this->Entrega;
    }

    public function setEntrega(Entrega $Entrega): self
    {
        $this->Entrega = $Entrega;

        return $this;
    }
}