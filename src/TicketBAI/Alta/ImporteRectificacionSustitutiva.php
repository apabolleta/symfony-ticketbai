<?php

namespace APM\TicketBAIBundle\TicketBAI\Alta;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\StructureInterface;

/**
 * Class to define TicketBAI 'ImporteRectificacionSustitutiva' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class ImporteRectificacionSustitutiva implements StructureInterface
{
    /**
     * Base imponible de la factura sustituida.
     *
     * Formato:         Decimal(12,2)
     * Obligatorio:     Sí
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
    private string $BaseRectificada;

    /**
     * Cuota repercutida de la factura sustituida.
     *
     * Formato:         Decimal(12,2)
     * Obligatorio:     Sí
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
    private string $CuotaRectificada;

    /**
     * Cuota del recargo de equivalencia de la factura sustituida.
     *
     * Formato:         Decimal(12,2)
     * Obligatorio:     No
     *
     * @access  private
     * @var     string
     *
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      max = 16
     * )
     * @Assert\Regex("/^(\+|-)?\d{1,12}(\.\d{0,2})?$/")
     */
    private string $CuotaRecargoRectificada;

    public function getBaseRectificada(): string
    {
        return $this->BaseRectificada;
    }

    public function setBaseRectificada(string $BaseRectificada): self
    {
        $this->BaseRectificada = $BaseRectificada;

        return $this;
    }

    public function getCuotaRectificada(): string
    {
        return $this->CuotaRectificada;
    }

    public function setCuotaRectificada(string $CuotaRectificada): self
    {
        $this->CuotaRectificada = $CuotaRectificada;

        return $this;
    }

    public function getCuotaRecargoRectificada(): string
    {
        return $this->CuotaRecargoRectificada;
    }

    public function setCuotaRecargoRectificada(string $CuotaRecargoRectificada): self
    {
        $this->CuotaRecargoRectificada = $CuotaRecargoRectificada;

        return $this;
    }
}