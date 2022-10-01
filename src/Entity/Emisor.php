<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class to define TicketBAI system 'Emisor' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class Emisor
{
    /**
     * NIF del emisor o de la emisora.
     * Formato:         FormatoNIF(9)
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type: 'alnum')
     * @Assert\Length(
     *      max: 9
     * )
     * @Assert\Regex("/^[0-9]{8}[A-Z]$/")
     */
    private string $NIF;

    /**
     * Apellidos y nombre o razón social o denominación social completa del emisor o de la emisora.
     * Formato:         Alfanumérico(120)
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type: 'alnum')
     * @Assert\Length(
     *      max: 120
     * )
     */
    private string $ApellidosNombreRazonSocial;

    public function getNIF(): string
    {
        return $this->NIF;
    }

    public function setNIF(string $NIF): self
    {
        $this->NIF = $NIF;

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
}