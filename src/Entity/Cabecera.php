<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\TicketBAI;

/**
 * Class to define TicketBAI 'Cabecera' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class Cabecera
{
    /**
     * Identificación de la versión de la estructura del fichero TicketBAI utilizado.
     *
     * Formato:             Alfanumérico(5)
     * Valores posibles:    L0
     * Obligatorio:         Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      max = 5
     * )
     * @Assert\Choice(choices=TicketBAI::L0_IDVersionTBAI)
     */
    private string $IDVersionTBAI;

    public function getIDVersionTBAI(): string
    {
        return $this->IDVersionTBAI;
    }

    public function setIDVersionTBAI(string $IDVersionTBAI): self
    {
        $this->IDVersionTBAI = $IDVersionTBAI;

        return $this;
    }
}