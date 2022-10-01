<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use APM\TicketBAIBundle\TicketBAI;

/**
 * Class to define TicketBAI system 'IDOtro' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class IDOtro
{
    /**
     * Código del país asociado al destinatario o a la destinataria.
     *
     * @access  private
     * @var     string
     *
     * @Assert\Country
     */
    private string $CodigoPais;

    /**
     * Clave para establecer el tipo de identificación en el país de residencia.
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Choice(choices=TicketBAI::L2_IDType)
     */
    private string $IDType;

    /**
     * Número de identificación en el país de residencia.
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      max: 20
     * )
     */
    private string $ID;

    public function getCodigoPais(): ?string
    {
        return $this->CodigoPais;
    }

    public function setCodigoPais(string $CodigoPais): self
    {
        $this->CodigoPais = $CodigoPais;

        return $this;
    }

    public function getIDType(): string
    {
        return $this->IDType;
    }

    public function setIDType(string $IDType): self
    {
        $this->IDType = $IDType;

        return $this;
    }

    public function getID(): string
    {
        return $this->ID;
    }

    public function setID(string $ID): self
    {
        $this->ID = $ID;

        return $this;
    }
}