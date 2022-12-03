<?php

namespace APM\TicketBAIBundle\TicketBAI\Alta;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\StructureInterface;
use APM\TicketBAIBundle\TicketBAI\TicketBAI;

/**
 * Class to define TicketBAI 'IDClave' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class IDClave implements StructureInterface
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
     * @Assert\Choice(choices=TicketBAI::L9_ClaveRegimenIVAOperacionTranscendencia)
     */
    private string $ClaveRegimenIvaOpTrascendencia;

    public function getClaveRegimenIVAOperacionTranscendencia(): string
    {
        return $this->ClaveRegimenIvaOpTrascendencia;
    }

    public function setClaveRegimenIVAOperacionTranscendencia(string $ClaveRegimenIVAOperacionTranscendencia): self
    {
        $this->ClaveRegimenIvaOpTrascendencia = $ClaveRegimenIVAOperacionTranscendencia;

        return $this;
    }
}