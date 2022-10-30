<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\TicketBAI;
use APM\TicketBAIBundle\Entity\FacturaRectificativa;
use APM\TicketBAIBundle\Entity\IDFacturaRectificadaSustituida;

/**
 * Class to define TicketBAI system 'CabeceraFactura' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class CabeceraFactura
{
    /**
     * Serie que identifica a la factura. Se recomienda:
     *
     * Utilizar el siguiente juego de caracteres: 0123456789ABCDEFGHJKLMNPQRSTUVXYZ.
     * Evitar las letras I, Ñ, O y W, para mejorar la legibilidad.
     * No emplear letras minúsculas.
     * Utilizar un único carácter para el empleo del espacio en blanco.
     * Ajustar el texto a la izquierda, sin que comience con espacios en blanco.
     * No utilizar acentos.
     * Puede utilizarse el guion medio “-“.
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
    private string $SerieFactura;

    /**
     * Número de factura que identifica a la factura. Se recomienda:
     *
     * El número de factura debería contener únicamente caracteres numéricos.
     * No debe comenzar con espacios en blanco (por lo tanto, texto ajustado a la izquierda).
     *
     * Formato:         Alfanumérico(20)
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Type(type="digit", groups={"strict"})
     * @Assert\Length(
     *      max = 20
     * )
     */
    private string $NumFactura;

    /**
     * Fecha de expedición de la factura.
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

    /**
     * Hora de expedición de la factura.
     *
     * Formato:             FormatoHora(8)
     * Valores posibles:    (hh:mm:ss)
     * Obligatorio:         Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min = 8,
     *      max = 8
     * )
     * @Assert\DateTime(format="H:i:s")
     */
    private string $HoraExpedicionFactura;

    /**
     * Identificador que especifica si se trata de una factura simplificada o una factura completa.
     * Si no se informa este campo se entenderá que tiene valor «N», entendiéndose que se trata de una
     * factura completa.
     *
     * Formato:             Alfanumérico(1)
     * Valores posibles:    L5
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
     * @Assert\Choice(choices=TicketBAI::L5_FacturaSimplificada)
     */
    private string $FacturaSimplificada;

    /**
     * Identificador que especifica si se trata de una factura emitida en sustitución de una factura simplificada.
     * Si no se informa este campo se entenderá que tiene valor «N».
     *
     * Formato:             Alfanumérico(1)
     * Valores posibles:    L6
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
     * @Assert\Choice(choices=TicketBAI::L6_FacturaEmitidaSustitucionSimplificada)
     */
    private string $FacturaEmitidaSustitucionSimplificada;

    /**
     * Obligatorio:         No
     *
     * @access  private
     * @var     FacturaRectificativa
     *
     * @Asert\Type(type=FacturaRectificativa::class)
     * @Assert\Valid
     */
    private FacturaRectificativa $FacturaRectificativa;

    /**
     * Obligatorio:         No
     * Agrupación:          IDFacturaRectificadaSustituida (1 a 100)
     *
     * @access  private
     * @var     array
     *
     * @Assert\Type(type="array")
     * @Assert\Count(
     *      min = 1,
     *      max = 100
     * )
     * @Assert\All({
     *      @Assert\NotNull,
     *      @Assert\Type(type=IDFacturaRectificadaSustituida::class)
     * })
     * @Assert\Valid
     */
    private array $FacturasRectificadasSustituidas;

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

    public function getHoraExpedicionFactura(): string
    {
        return $this->HoraExpedicionFactura;
    }

    public function setHoraExpedicionFactura(string $HoraExpedicionFactura): self
    {
        $this->HoraExpedicionFactura = $HoraExpedicionFactura;

        return $this;
    }

    public function getFacturaSimplificada(): ?string
    {
        return $this->FacturaSimplificada;
    }

    public function setFacturaSimplificada(string $FacturaSimplificada): self
    {
        $this->FacturaSimplificada = $FacturaSimplificada;

        return $this;
    }

    public function getFacturaEmitidaSustitucionSimplificada(): ?string
    {
        return $this->FacturaEmitidaSustitucionSimplificada;
    }

    public function setFacturaEmitidaSustitucionSimplificada(string $FacturaEmitidaSustitucionSimplificada): self
    {
        $this->FacturaEmitidaSustitucionSimplificada = $FacturaEmitidaSustitucionSimplificada;

        return $this;
    }

    public function getFacturaRectificativa(): ?FacturaRectificativa
    {
        return $this->FacturaRectificativa;
    }

    public function setFacturaRectificativa(FacturaRectificativa $FacturaRectificativa): self
    {
        $this->FacturaRectificativa = $FacturaRectificativa;

        return $this;
    }

    public function getFacturasRectificadasSustituidas(): ?array
    {
        return $this->FacturasRectificadasSustituidas;
    }

    public function setFacturasRectificadasSustituidas(array $FacturasRectificadasSustituidas): self
    {
        $this->FacturasRectificadasSustituidas = $FacturasRectificadasSustituidas;

        return $this;
    }
}