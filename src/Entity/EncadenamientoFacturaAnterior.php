<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class to define TicketBAI system 'EncadenamientoFacturaAnterior' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class EncadenamientoFacturaAnterior
{
    /**
     * Serie que identifica a la factura anterior.
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
     * @Assert\Regex("/^[-0123456789ABCDEFGHJKLMNPQRSTUVXYZ]{1,20}$/", groups={"strict"})
     */
    private string $SerieFacturaAnterior;

    /**
     * Número de factura que identifica a la factura anterior.
     *
     * Formato:         Alfanumérico(20)
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      max = 20
     * )
     * @Assert\Regex("/^\d{1,20}$/", groups={"strict"})
     */
    private string $NumFacturaAnterior;

    /**
     * Fecha de expedición de la factura anterior.
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
    private string $FechaExpedicionFacturaAnterior;

    /**
     * Primeros cien caracteres del campo SignatureValue del fichero TicketBAI de la factura anterior.
     *
     * Formato:         Alfanumérico(100)
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min = 100,
     *      max = 100
     * )
     */
    private string $SignatureValueFirmaFacturaAnterior;

    public function getSerieFacturaAnterior(): ?string
    {
        return $this->SerieFacturaAnterior;
    }

    public function setSerieFacturaAnterior(string $SerieFacturaAnterior): self
    {
        $this->SerieFacturaAnterior = $SerieFacturaAnterior;

        return $this;
    }

    public function getNumFacturaAnterior(): string
    {
        return $this->NumFacturaAnterior;
    }

    public function setNumFacturaAnterior(string $NumFacturaAnterior): self
    {
        $this->NumFacturaAnterior = $NumFacturaAnterior;

        return $this;
    }

    public function getFechaExpedicionFacturaAnterior(): string
    {
        return $this->FechaExpedicionFacturaAnterior;
    }

    public function setFechaExpedicionFacturaAnterior(string $FechaExpedicionFacturaAnterior): self
    {
        $this->FechaExpedicionFacturaAnterior = $FechaExpedicionFacturaAnterior;

        return $this;
    }

    public function getSignatureValueFirmaFacturaAnterior(): string
    {
        return $this->SignatureValueFirmaFacturaAnterior;
    }

    public function setSignatureValueFirmaFacturaAnterior(string $SignatureValueFirmaFacturaAnterior): self
    {
        $this->SignatureValueFirmaFacturaAnterior = $SignatureValueFirmaFacturaAnterior;

        return $this;
    }
}