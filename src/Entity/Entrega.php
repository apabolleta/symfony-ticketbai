<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\Entity\Sujeta;
use APM\TicketBAIBundle\Entity\NoSujeta;

/**
 * Class to define TicketBAI system 'Entrega' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class Entrega
{
    /**
     * Obligatorio:         No
     *
     * @access  private
     * @var     Sujeta
     *
     * @Assert\Type(type="Sujeta")
     * @Assert\Valid
     */
    private Sujeta $Sujeta;

    /**
     * Obligatorio:         No
     *
     * @access  private
     * @var     NoSujeta
     *
     * @Assert\Type(type="NoSujeta")
     * @Assert\Valid
     */
    private NoSujeta $NoSujeta;

    public function getSujeta(): ?Sujeta
    {
        return $this->Sujeta;
    }

    public function setSujeta(Sujeta $Sujeta): self
    {
        $this->Sujeta = $Sujeta;

        return $this;
    }

    public function getNoSujeta(): ?NoSujeta
    {
        return $this->NoSujeta;
    }

    public function setNoSujeta(NoSujeta $NoSujeta): self
    {
        $this->NoSujeta = $NoSujeta;

        return $this;
    }
}