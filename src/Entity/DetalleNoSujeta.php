<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\TicketBAI;

/**
 * Class to define TicketBAI 'DetalleNoSujeta' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class DetalleNoSujeta
{
    /**
     * Causa de la no sujeción.
     *
     * Formato:             Alfanumérico(2)
     * Valores posibles:    L13
     * Obligatorio:         Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min = 2,
     *      max = 2
     * )
     * @Assert\Choice(choices=TicketBAI::L13_Causa)
     */
    private string $Causa;

    /**
     * Importe en euros correspondiente a la operación no sujeta.
     *
     * Formato:             Decimal(12,2)
     * Obligatorio:         Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      max = 16
     * )
     * @Assert\Regex("/^(\+|-)?\d{1,12}(\.\d{0,2})?$/")
     */
    private string $Importe;

    public function getCausa(): string
    {
        return $this->Causa;
    }

    public function setCausa(string $Causa): self
    {
        $this->Causa = $Causa;

        return $this;
    }

    public function getImporte(): string
    {
        return $this->Importe;
    }

    public function setImporte(string $Importe): self
    {
        $this->Importe = $Importe;

        return $this;
    }
}