<?php

namespace APM\TicketBAIBundle\TicketBAI\Alta;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\StructureInterface;

/**
 * Class to define TicketBAI 'IDDetalleFactura' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class IDDetalleFactura implements StructureInterface
{
    /**
     * Descripción del detalle de la línea de factura.
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
    private string $DescripcionDetalle;

    /**
     * Cantidad de la línea de factura.
     *
     * Formato:         Decimal(12,8)
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      max = 22
     * )
     * @Assert\Regex("/^(\+|-)?\d{1,12}(\.\d{0,8})?$/")
     */
    private string $Cantidad;

    /**
     * Importe unitario SIN IVA de la línea de factura.
     *
     * Formato:         Decimal(12,8)
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      max = 22
     * )
     * @Assert\Regex("/^(\+|-)?\d{1,12}(\.\d{0,8})?$/")
     */
    private string $ImporteUnitario;

    /**
     * Importe en euros del descuento de la línea de factura.
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
    private string $Descuento;

    /**
     * Importe total CON IVA de la línea de factura.
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
    private string $ImporteTotal;

    public function getDescripcionDetalle(): string
    {
        return $this->DescripcionDetalle;
    }

    public function setDescripcionDetalle(string $DescripcionDetalle): self
    {
        $this->DescripcionDetalle = $DescripcionDetalle;

        return $this;
    }

    public function getCantidad(): string
    {
        return $this->Cantidad;
    }

    public function setCantidad(string $Cantidad): self
    {
        $this->Cantidad = $Cantidad;

        return $this;
    }

    public function getImporteUnitario(): string
    {
        return $this->ImporteUnitario;
    }

    public function setImporteUnitario(string $ImporteUnitario): self
    {
        $this->ImporteUnitario = $ImporteUnitario;

        return $this;
    }

    public function getDescuento(): string
    {
        return $this->Descuento;
    }

    public function setDescuento(string $Descuento): self
    {
        $this->Descuento = $Descuento;

        return $this;
    }

    public function getImporteTotal(): string
    {
        return $this->ImporteTotal;
    }

    public function setImporteTotal(string $ImporteTotal): self
    {
        $this->ImporteTotal = $ImporteTotal;

        return $this;
    }
}