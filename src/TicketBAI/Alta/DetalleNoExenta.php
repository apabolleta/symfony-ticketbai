<?php

namespace APM\TicketBAIBundle\TicketBAI\Alta;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\TicketBAI\TicketBAI;
use APM\TicketBAIBundle\TicketBAI\Alta\DetalleIVA;

/**
 * Class to define TicketBAI 'DetalleNoExenta' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class DetalleNoExenta
{
    /**
     * Tipo de operación sujeta y no exenta.
     *
     * Formato:             Alfanumérico(2)
     * Valores posibles:    L11
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
     * @Assert\Choice(choices=TicketBAI::L11_TipoNoExenta)
     */
    private string $TipoNoExenta;

    /**
     * Obligatorio:         Sí
     * Agrupación:          DetalleIVA (1 a 6, una agrupación de datos por tipo)
     *
     * @access  private
     * @var     array
     *
     * @Assert\NotNull
     * @Assert\Type(type="array")
     * @Assert\Count(
     *      min = 1,
     *      max = 6
     * )
     * @Assert\All({
     *      @Assert\NotNull,
     *      @Assert\Type(type=DetalleIVA::class)
     * })
     * @Assert\Valid
     */
    private array $DesgloseIVA;

    public function getTipoNoExenta(): string
    {
        return $this->TipoNoExenta;
    }

    public function setTipoNoExenta(string $TipoNoExenta): self
    {
        $this->TipoNoExenta = $TipoNoExenta;

        return $this;
    }

    public function getDesgloseIVA(): array
    {
        return $this->DesgloseIVA;
    }

    public function setDesgloseIVA(array $DesgloseIVA): self
    {
        $this->DesgloseIVA = $DesgloseIVA;

        return $this;
    }
}