<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\TicketBAI;
use APM\TicketBAIBundle\Entity\Emisor;
use APM\TicketBAIBundle\Entity\IDDestinatario;

/**
 * Class to define TicketBAI system 'Sujetos' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class Sujetos
{
    /**
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     Emisor
     *
     * @Assert\NotNull
     * @Assert\Type(type=Emisor::class)
     * @Assert\Valid
     */
    private Emisor $Emisor;

    /**
     * Obligatorio:     No
     * Agrupación:      IDDestiantario (1 a 100)
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
     *      @Assert\Type(type=IDDestinatario::class)
     * })
     * @Assert\Valid
     */
    private array $Destinatarios;

    /**
     * Identificador que especifica si la factura tiene varios destinatarios o varias destinatarias.
     * Si no se informa este campo se entenderá que tiene valor «N».
     *
     * Formato:             Alfanumérico(1)
     * Valores posibles:    L3
     * Obligatorio:         No
     *
     * @access  private
     * @var     string
     *
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min = 1,
     *      max = 1
     * )
     * @Assert\Choice(choices=TicketBAI::L3_VariosDestinatarios)
     */
    private string $VariosDestinatarios;

    /**
     * Identificador que especifica si la factura ha sido emitida por un tercero o por el destinatario o la destinataria.
     * Si no se informa este campo se entenderá que tiene valor «N».
     *
     * Formato:             Alfanumérico(1)
     * Valores posibles:    L4
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
     * @Assert\Choice(choices=TicketBAI::L4_EmitidaPorTercerosODestinatario)
     */
    private string $EmitidaPorTercerosODestinatario;

    public function getEmisor(): Emisor
    {
        return $this->Emisor;
    }

    public function setEmisor(Emisor $Emisor): self
    {
        $this->Emisor = $Emisor;

        return $this;
    }

    public function getDestinatarios(): ?array
    {
        return $this->Destinatarios;
    }

    public function setDestinatarios(array $Destinatarios): self
    {
        $this->Destinatarios = $Destinatarios;

        return $this;
    }

    public function getVariosDestinatarios(): ?string
    {
        return $this->VariosDestinatarios;
    }

    public function setVariosDestinatarios(string $VariosDestinatarios): self
    {
        $this->VariosDestinatarios = $VariosDestinatarios;

        return $this;
    }

    public function getEmitidaPorTercerosODestinatario(): ?string
    {
        return $this->EmitidaPorTercerosODestinatario;
    }

    public function setEmitidaPorTercerosODestinatario(string $EmitidaPorTercerosODestinatario): self
    {
        $this->EmitidaPorTercerosODestinatario = $EmitidaPorTercerosODestinatario;

        return $this;
    }
}