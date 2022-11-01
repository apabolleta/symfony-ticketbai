<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\Entity\Cabecera;
use APM\TicketBAIBundle\Entity\Sujetos;
use APM\TicketBAIBundle\Entity\Factura;
use APM\TicketBAIBundle\Entity\HuellaTBAI;

/**
 * Class to define TicketBAI system 'FicheroAlta' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class FicheroAlta
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
     * @var     Sujetos
     *
     * @Assert\NotNull
     * @Assert\Type(type=Sujetos::class)
     * @Assert\Valid
     */
    private Sujetos $Sujetos;

    /**
     * Obligatorio:         Sí
     *
     * @access  private
     * @var     Factura
     *
     * @Assert\NotNull
     * @Assert\Type(type=Factura::class)
     * @Assert\Valid
     */
    private Factura $Factura;

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

    public function getSujetos(): Sujetos
    {
        return $this->Sujetos;
    }

    public function setSujetos(Sujetos $Sujetos): self
    {
        $this->Sujetos = $Sujetos;

        return $this;
    }

    public function getFactura(): Factura
    {
        return $this->Factura;
    }

    public function setFactura(Factura $Factura): self
    {
        $this->Factura = $Factura;

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