<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\Entity\Cabecera;
use APM\TicketBAIBundle\Entity\IDFactura;
use APM\TicketBAIBundle\Entity\HuellaTBAI;

/**
 * Class to define TicketBAI system 'FicheroAnulacion' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class FicheroAnulacion
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
     * @var     string
     *
     * @Assert\Type(type="string")
     */
    private string $Signature;

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

    public function getSignature(): string
    {
        return $this->Signature;
    }

    public function setSignature(string $Signature): self
    {
        $this->Signature = $Signature;

        return $this;
    }
}