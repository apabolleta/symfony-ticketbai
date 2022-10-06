<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\Entity\Sujeta;
use APM\TicketBAIBundle\Entity\DetalleNoSujeta;

/**
 * Class to define TicketBAI system 'PrestacionServicios' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class PrestacionServicios
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
     * Agrupación:          DetalleNoSujeta (1 a 2)
     *
     * @access  private
     * @var     array
     *
     * @Assert\Type(type="array")
     * @Assert\Count(
     *      min = 1,
     *      max = 2
     * )
     * @Assert\All({
     *      @Assert\NotNull,
     *      @Assert\Type(type="DetalleNoSujeta"),
     *      @Assert\Valid
     * })
     */
    private array $NoSujeta;

    public function getSujeta(): ?Sujeta
    {
        return $this->Sujeta;
    }

    public function setSujeta(Sujeta $Sujeta): self
    {
        $this->Sujeta = $Sujeta;

        return $this;
    }

    public function getNoSujeta(): ?array
    {
        return $this->NoSujeta;
    }

    public function setNoSujeta(array $NoSujeta): self
    {
        $this->NoSujeta = $NoSujeta;

        return $this;
    }
}