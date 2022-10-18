<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class to define TicketBAI system 'IDClave' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class IDClave
{
    /**
     * Clave que identifica el tipo de régimen del IVA o una operación con transcendencia tributaria.
     *
     * Formato:             Alfanumérico(2)
     * Valores posibles:    L9
     * Obligatorio:         Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min = 2,
     *      max = 2
     * )
     * @Assert\Choice(choices=APM\TicketBAIBundle\TicketBAI::L9_ClaveRegimenIVAOperacionTranscendencia)
     */
    private string $ClaveRegimenIVAOperacionTranscendencia;

    public function getClaveRegimenIVAOperacionTranscendencia(): string
    {
        return $this->ClaveRegimenIVAOperacionTranscendencia;
    }

    public function setClaveRegimenIVAOperacionTranscendencia(string $ClaveRegimenIVAOperacionTranscendencia): self
    {
        $this->ClaveRegimenIVAOperacionTranscendencia = $ClaveRegimenIVAOperacionTranscendencia;

        return $this;
    }
}