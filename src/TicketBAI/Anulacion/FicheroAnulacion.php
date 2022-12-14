<?php

namespace APM\TicketBAIBundle\TicketBAI\Anulacion;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\StructureInterface;
use APM\TicketBAIBundle\TicketBAI\Anulacion\Cabecera;
use APM\TicketBAIBundle\TicketBAI\Anulacion\IDFactura;
use APM\TicketBAIBundle\TicketBAI\Anulacion\HuellaTBAI;

/**
 * Class to define TicketBAI 'FicheroAnulacion' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class FicheroAnulacion implements StructureInterface
{
    /**
     * Obligatorio:         Sí
     *
     * @access  private
     * @var     Cabecera
     *
     * @Assert\NotNull
     * @Assert\Type(type=Cabecera::class)
     * @Assert\Valid
     */
    private Cabecera $Cabecera;

    /**
     * Obligatorio:         Sí
     *
     * @access  private
     * @var     IDFactura
     *
     * @Assert\NotNull
     * @Assert\Type(type=IDFactura::class)
     * @Assert\Valid
     */
    private IDFactura $IDFactura;

    /**
     * Obligatorio:         Sí
     *
     * @access  private
     * @var     HuellaTBAI
     *
     * @Assert\NotNull
     * @Assert\Type(type=HuellaTBAI::class)
     * @Assert\Valid
     */
    private HuellaTBAI $HuellaTBAI;

    /**
     * Ver “Especificaciones de la firma electrónica de los ficheros TicketBAI” en el anexo III.
     *
     * @access  private
     * @var     mixed
     *
     */
    private $Signature;

    public function getCabecera(): Cabecera
    {
        return $this->Cabecera;
    }

    public function setCabecera(Cabecera $Cabecera): self
    {
        $this->Cabecera = $Cabecera;

        return $this;
    }

    public function getIDFactura(): IDFactura
    {
        return $this->IDFactura;
    }

    public function setIDFactura(IDFactura $IDFactura): self
    {
        $this->IDFactura = $IDFactura;

        return $this;
    }

    public function getHuellaTBAI(): HuellaTBAI
    {
        return $this->HuellaTBAI;
    }

    public function setHuellaTBAI(HuellaTBAI $HuellaTBAI): self
    {
        $this->HuellaTBAI = $HuellaTBAI;

        return $this;
    }

    public function getSignature()
    {
        return $this->Signature;
    }

    public function setSignature($Signature): self
    {
        $this->Signature = $Signature;

        return $this;
    }
}