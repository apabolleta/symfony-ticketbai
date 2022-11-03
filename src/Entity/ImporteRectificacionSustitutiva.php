<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class to define TicketBAI system 'ImporteRectificacionSustitutiva' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class ImporteRectificacionSustitutiva
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

    public function getCuotaRecargoRectificada(): ?string
    {
        return $this->CuotaRecargoRectificada;
    }

    public function setCuotaRecargoRectificada(string $CuotaRecargoRectificada): self
    {
        $this->CuotaRecargoRectificada = $CuotaRecargoRectificada;

        return $this;
    }
}