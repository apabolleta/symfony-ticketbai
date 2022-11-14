<?php

namespace APM\TicketBAIBundle\TicketBAI\Alta;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\TicketBAI\Alta\DetalleExenta;
use APM\TicketBAIBundle\TicketBAI\Alta\DetalleNoExenta;

/**
 * Class to define TicketBAI 'Sujeta' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class Sujeta
{
    /**
     * Obligatorio:         No
     * Agrupación:          DetalleExenta (1 a 7, una agrupación de datos por causa de exención)
     *
     * @access  private
     * @var     array
     *
     * @Assert\Type(type="array")
     * @Assert\Count(
     *      min = 1,
     *      max = 7
     * )
     * @Assert\All({
     *      @Assert\NotNull,
     *      @Assert\Type(type=DetalleExenta::class)
     * })
     * @Assert\Valid
     */
    private array $Exenta;

    /**
     * Obligatorio:         No
     * Agrupación:          DetalleNoExenta (1 a 2)
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
     *      @Assert\Type(type=DetalleNoExenta::class)
     * })
     * @Assert\Valid
     */
    private array $NoExenta;

    public function getExenta(): ?array
    {
        return $this->Exenta;
    }

    public function setExenta(array $Exenta): self
    {
        $this->Exenta = $Exenta;

        return $this;
    }

    public function getNoExenta(): ?array
    {
        return $this->NoExenta;
    }

    public function setNoExenta(array $NoExenta): self
    {
        $this->NoExenta = $NoExenta;

        return $this;
    }
}