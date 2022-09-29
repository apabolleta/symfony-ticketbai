<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use APM\TicketBAIBundle\TicketBAI;

/**
 * Class to define TicketBAI system 'Cabecera' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class Cabecera
{
    /**
     * @Assert\NotBlank
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