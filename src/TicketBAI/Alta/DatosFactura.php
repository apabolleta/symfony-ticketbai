<?php

namespace APM\TicketBAIBundle\TicketBAI\Alta;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\StructureInterface;
use APM\TicketBAIBundle\TicketBAI\Alta\IDDetalleFactura;
use APM\TicketBAIBundle\TicketBAI\Alta\IDClave;

/**
 * Class to define TicketBAI 'DatosFactura' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class DatosFactura implements StructureInterface
{
    /**
     * Fecha en la que se ha realizado la operación siempre que sea diferente a la fecha de expedición.
     *
     * Formato:             FormatoFecha(10)
     * Valores posibles:    (dd-mm-aaaa)
     * Obligatorio:         No
     *
     * @access  private
     * @var     string
     *
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min = 10,
     *      max = 10
     * )
     * @Assert\DateTime(format="d-m-Y")
     */
    private string $FechaOperacion;

    /**
     * Descripción general de las operaciones.
     *
     * Formato:         Alfanumérico(250)
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      max = 250
     * )
     */
    private string $DescripcionFactura;

    /**
     * Obligatorio:     Sí (Gipuzkoa)
     * Agrupación:      IDDetalleFactura (1 a 1000)
     *
     * @access  private
     * @var     array
     *
     * @Assert\NotNull(groups={"Gipuzkoa"})
     * @Assert\Type(type="array")
     * @Assert\Count(
     *      min = 1,
     *      max = 1000
     * )
     * @Assert\All({
     *      @Assert\NotNull,
     *      @Assert\Type(type=IDDetalleFactura::class)
     * })
     * @Assert\Valid
     */
    private array $DetallesFactura;

    /**
     * Importe total de la factura.
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
    private string $ImporteTotalFactura;

    /**
     * Retención soportada.
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
    private string $RetencionSoportada;

    /**
     * Base imponible a coste (para grupos de IVA – nivel avanzado).
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
    private string $BaseImponibleACoste;

    /**
     * Obligatorio:     Sí
     * Agrupación:      IDClave (1 a 3)
     *
     * @access  private
     * @var     array
     *
     * @Assert\NotNull
     * @Assert\Type(type="array")
     * @Assert\Count(
     *      min = 1,
     *      max = 3
     * )
     * @Assert\All({
     *      @Assert\NotNull,
     *      @Assert\Type(type=IDClave::class)
     * })
     * @Assert\Valid
     */
    private array $Claves;

    public function getFechaOperacion(): string
    {
        return $this->FechaOperacion;
    }

    public function setFechaOperacion(string $FechaOperacion): self
    {
        $this->FechaOperacion = $FechaOperacion;

        return $this;
    }

    public function getDescripcionFactura(): string
    {
        return $this->DescripcionFactura;
    }

    public function setDescripcionFactura(string $DescripcionFactura): self
    {
        $this->DescripcionFactura = $DescripcionFactura;

        return $this;
    }

    public function getDetallesFactura(): array
    {
        return $this->DetallesFactura;
    }

    public function setDetallesFactura(array $DetallesFactura): self
    {
        $this->DetallesFactura = $DetallesFactura;

        return $this;
    }

    public function getImporteTotalFactura(): string
    {
        return $this->ImporteTotalFactura;
    }

    public function setImporteTotalFactura(string $ImporteTotalFactura): self
    {
        $this->ImporteTotalFactura = $ImporteTotalFactura;

        return $this;
    }

    public function getRetencionSoportada(): string
    {
        return $this->RetencionSoportada;
    }

    public function setRetencionSoportada(string $RetencionSoportada): self
    {
        $this->RetencionSoportada = $RetencionSoportada;

        return $this;
    }

    public function getBaseImponibleACoste(): string
    {
        return $this->BaseImponibleACoste;
    }

    public function setBaseImponibleACoste(string $BaseImponibleACoste): self
    {
        $this->BaseImponibleACoste = $BaseImponibleACoste;

        return $this;
    }

    public function getClaves(): array
    {
        return $this->Claves;
    }

    public function setClaves(array $Claves): self
    {
        $this->Claves = $Claves;

        return $this;
    }
}