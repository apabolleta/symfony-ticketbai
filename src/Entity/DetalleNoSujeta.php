<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class to define TicketBAI system 'DetalleNoSujeta' structure.
 *
 * @package  apabolleta/ticketbai-bundle
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
     * @Assert\Type(type="alnum")
     * @Assert\Length(
     *      min = 2,
     *      max = 2
     * )
     * @Assert\Choice(choices=APM\TicketBAIBundle\TicketBAI::L13_Causa)
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
     *      max = 15
     * )
     * @Assert\Regex("/^[0-9]{1,12}([,][0-9]{1,2})?$/")
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