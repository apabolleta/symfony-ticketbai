<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class to define TicketBAI system 'DetalleExenta' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class DetalleExenta
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
     * @Assert\Choice(choices=APM\TicketBAIBundle\TicketBAI::L10_CausaExencion)
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
     *      max = 15
     * )
     * @Assert\Regex("/^[0-9]{1,12}([,][0-9]{1,2})?$/")
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