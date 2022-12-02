<?php

namespace APM\TicketBAIBundle\TicketBAI\Alta;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\StructureInterface;
use APM\TicketBAIBundle\TicketBAI\TicketBAI;

/**
 * Class to define TicketBAI 'DetalleExenta' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class DetalleExenta implements StructureInterface
{
    /**
     * Causa de la exención.
     *
     * Formato:             Alfanumérico(2)
     * Valores posibles:    L10
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
     * @Assert\Choice(choices=TicketBAI::L10_CausaExencion)
     */
    private string $CausaExencion;

    /**
     * Base imponible exenta en euros correspondiente a la causa de exención.
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
    private string $BaseImponible;

    public function getCausaExencion(): string
    {
        return $this->CausaExencion;
    }

    public function setCausaExencion(string $CausaExencion): self
    {
        $this->CausaExencion = $CausaExencion;

        return $this;
    }

    public function getBaseImponible(): string
    {
        return $this->BaseImponible;
    }

    public function setBaseImponible(string $BaseImponible): self
    {
        $this->BaseImponible = $BaseImponible;

        return $this;
    }
}