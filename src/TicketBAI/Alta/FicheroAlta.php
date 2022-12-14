<?php

namespace APM\TicketBAIBundle\TicketBAI\Alta;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\StructureInterface;
use APM\TicketBAIBundle\TicketBAI\Alta\Cabecera;
use APM\TicketBAIBundle\TicketBAI\Alta\Sujetos;
use APM\TicketBAIBundle\TicketBAI\Alta\Factura;
use APM\TicketBAIBundle\TicketBAI\Alta\HuellaTBAI;

/**
 * Class to define TicketBAI 'FicheroAlta' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class FicheroAlta implements StructureInterface
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