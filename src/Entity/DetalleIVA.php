<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\TicketBAI;

/**
 * Class to define TicketBAI system 'DetalleIVA' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class DetalleIVA
{
    /**
     * Base imponible no exenta. Sobre la base imponible se aplica el tipo impositivo.
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
    private string $BaseImponible;

    /**
     * Porcentaje aplicado sobre la base imponible para calcular la cuota.
     *
     * Formato:         Decimal(3,2)
     * Obligatorio:     No
     *
     * @access  private
     * @var     string
     *
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      max = 6
     * )
     * @Assert\Regex("/^\d{1,3}(\.\d{0,2})?$/")
     */
    private string $TipoImpositivo;

    /**
     * Cuota repercutida. Será la cuota resultante de aplicar a la base imponible el tipo impositivo.
     *
     * Formato:             Decimal(12,2)
     * Obligatorio:         No
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
    private string $CuotaImpuesto;

    /**
     * Porcentaje asociado en función del tipo de IVA.
     *
     * Formato:             Decimal(3,2)
     * Obligatorio:         No
     *
     * @access  private
     * @var     string
     *
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      max = 6
     * )
     * @Assert\Regex("/^\d{1,3}(\.\d{0,2})?$/")
     */
    private string $TipoRecargoEquivalencia;

    /**
     * Cuota resultante de aplicar a la base imponible el tipo de recargo de equivalencia.
     *
     * Formato:             Decimal(12,2)
     * Obligatorio:         No
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
    private string $CuotaRecargoEquivalencia;

    /**
     * Identificador que especifica si se trata de una factura expedida por un contribuyente en régimen simplificado o en régimen de recargo de equivalencia.
     * Si no se informa este campo se entenderá que tiene valor «N».
     *
     * Formato:             Alfanumérico(1)
     * Valores posibles:    L12
     * Obligatorio:         No
     * Valor por defecto:   "N"
     *
     * @access  private
     * @var     string
     *
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min = 1,
     *      max = 1
     * )
     * @Assert\Choice(choices=TicketBAI::L12_OperacionEnRecargoDeEquivalenciaORegimenSimplificado)
     */
    private string $OperacionEnRecargoDeEquivalenciaORegimenSimplificado;

    public function getBaseImponible(): string
    {
        return $this->BaseImponible;
    }

    public function setBaseImponible(string $BaseImponible): self
    {
        $this->BaseImponible = $BaseImponible;

        return $this;
    }

    public function getTipoImpositivo(): ?string
    {
        return $this->TipoImpositivo;
    }

    public function setTipoImpositivo(string $TipoImpositivo): self
    {
        $this->TipoImpositivo = $TipoImpositivo;

        return $this;
    }

    public function getCuotaImpuesto(): ?string
    {
        return $this->CuotaImpuesto;
    }

    public function setCuotaImpuesto(string $CuotaImpuesto): self
    {
        $this->CuotaImpuesto = $CuotaImpuesto;

        return $this;
    }

    public function getTipoRecargoEquivalencia(): ?string
    {
        return $this->TipoRecargoEquivalencia;
    }

    public function setTipoRecargoEquivalencia(string $TipoRecargoEquivalencia): self
    {
        $this->TipoRecargoEquivalencia = $TipoRecargoEquivalencia;

        return $this;
    }

    public function getCuotaRecargoEquivalencia(): ?string
    {
        return $this->CuotaRecargoEquivalencia;
    }

    public function setCuotaRecargoEquivalencia(string $CuotaRecargoEquivalencia): self
    {
        $this->CuotaRecargoEquivalencia = $CuotaRecargoEquivalencia;

        return $this;
    }

    public function getOperacionEnRecargoDeEquivalenciaORegimenSimplificado(): ?string
    {
        return $this->OperacionEnRecargoDeEquivalenciaORegimenSimplificado;
    }

    public function setOperacionEnRecargoDeEquivalenciaORegimenSimplificado(string $OperacionEnRecargoDeEquivalenciaORegimenSimplificado): self
    {
        $this->OperacionEnRecargoDeEquivalenciaORegimenSimplificado = $OperacionEnRecargoDeEquivalenciaORegimenSimplificado;

        return $this;
    }
}