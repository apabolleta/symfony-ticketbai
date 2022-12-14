<?php

namespace APM\TicketBAIBundle\TicketBAI\Alta;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\GroupSequenceProviderInterface;

use APM\TicketBAIBundle\StructureInterface;
use APM\TicketBAIBundle\TicketBAI\Alta\IDOtro;

/**
 * Class to define TicketBAI 'IDDestinatario' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 * @Assert\GroupSequenceProvider
 *
 */
class IDDestinatario implements StructureInterface, GroupSequenceProviderInterface
{
    /**
     * NIF del destinatario o de la destinataria.
     *
     * Formato:             FormatoNIF(9)
     * Obligatorio:         Sí
     * Campo excluyente:    IDOtro
     *
     * @access  private
     * @var     string
     *
     * @Assert\IsNull(groups={"IsInternational"})
     * @Assert\NotBlank(groups={"IsNational"})
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min = 9,
     *      max = 9
     * )
     * @Assert\Regex("/^(([a-z|A-Z]{1}\d{7}[a-z|A-Z]{1})|(\d{8}[a-z|A-Z]{1})|([a-z|A-Z]{1}\d{8}))$/")
     */
    private string $NIF;

    /**
     * Obligatorio:         Sí
     * Campo excluyente:    NIF
     *
     * @access  private
     * @var     IDOtro
     *
     * @Assert\IsNull(groups={"IsNational"})
     * @Assert\NotNull(groups={"IsInternational"})
     * @Assert\Type(type=IDOtro::class)
     * @Assert\Valid
     */
    private IDOtro $IDOtro;

    /**
     * Apellidos y nombre o razón social o denominación social completa del destinatario o de la destinataria.
     *
     * Formato:         Alfanumérico(120)
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      max = 120
     * )
     */
    private string $ApellidosNombreRazonSocial;

    /**
     * Código postal del destinatario o de la destinataria.
     *
     * Formato:         Alfanumérico(20)
     * Obligatorio:     Sí (Gipuzkoa)
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank(groups={"Gipuzkoa"})
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      max = 20
     * )
     */
    private string $CodigoPostal;

    /**
     * Dirección postal del destinatario o de la destinataria.
     *
     * Formato:         Alfanumérico(250)
     * Obligatorio:     Sí (Gipuzkoa)
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank(groups={"Gipuzkoa"})
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      max = 250
     * )
     */
    private string $Direccion;

    public function getNIF(): string
    {
        return $this->NIF;
    }

    public function setNIF(string $NIF): self
    {
        $this->NIF = $NIF;

        return $this;
    }

    public function getIDOtro(): IDOtro
    {
        return $this->IDOtro;
    }

    public function setIDOtro(IDOtro $IDOtro): self
    {
        $this->IDOtro = $IDOtro;

        return $this;
    }

    public function getApellidosNombreRazonSocial(): string
    {
        return $this->ApellidosNombreRazonSocial;
    }

    public function setApellidosNombreRazonSocial(string $ApellidosNombreRazonSocial): self
    {
        $this->ApellidosNombreRazonSocial = $ApellidosNombreRazonSocial;

        return $this;
    }

    public function getCodigoPostal(): string
    {
        return $this->CodigoPostal;
    }

    public function setCodigoPostal(string $CodigoPostal): self
    {
        $this->CodigoPostal = $CodigoPostal;

        return $this;
    }

    public function getDireccion(): string
    {
        return $this->Direccion;
    }

    public function setDireccion(string $Direccion): self
    {
        $this->Direccion = $Direccion;

        return $this;
    }

    public function getGroupSequence()
    {
        return [[
            'IDDestinatario',
            isset($this->NIF) ? 'IsNational' : 'IsInternational'
        ]];
    }
}