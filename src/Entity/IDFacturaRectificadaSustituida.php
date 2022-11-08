<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class to define TicketBAI 'IDFacturaRectificadaSustituida' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class IDFacturaRectificadaSustituida
{
    /**
     * Número de serie que identifica a la factura rectificada o sustituida.
     *
     * Formato:         Alfanumérico(20)
     * Obligatorio:     No
     *
     * @access  private
     * @var     string
     *
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      max = 20
     * )
     * @Assert\Regex("/^[-0123456789ABCDEFGHJKLMNPQRSTUVXYZ]{1,20}$/", groups={"Strict"})
     */
    private string $SerieFactura;

    /**
     * Número de factura, que identifica a la factura rectificada o sustituida.
     *
     * Formato:         Alfanumérico(20)
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Type(type="digit", groups={"Strict"})
     * @Assert\Length(
     *      max = 20
     * )
     */
    private string $NumFactura;

    /**
     * Fecha de expedición de la factura rectificada o sustituida.
     *
     * Formato:             FormatoFecha(10)
     * Valores posibles:    (dd-mm-aaaa)
     * Obligatorio:         Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min = 10,
     *      max = 10
     * )
     * @Assert\DateTime(format="d-m-Y")
     */
    private string $FechaExpedicionFactura;

    public function getSerieFactura(): ?string
    {
        return $this->SerieFactura;
    }

    public function setSerieFactura(string $SerieFactura): self
    {
        $this->SerieFactura = $SerieFactura;

        return $this;
    }

    public function getNumFactura(): string
    {
        return $this->NumFactura;
    }

    public function setNumFactura(string $NumFactura): self
    {
        $this->NumFactura = $NumFactura;

        return $this;
    }

    public function getFechaExpedicionFactura(): string
    {
        return $this->FechaExpedicionFactura;
    }

    public function setFechaExpedicionFactura(string $FechaExpedicionFactura): self
    {
        $this->FechaExpedicionFactura = $FechaExpedicionFactura;

        return $this;
    }
}