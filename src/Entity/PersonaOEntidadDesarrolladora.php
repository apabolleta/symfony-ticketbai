<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\GroupSequenceProviderInterface;

use APM\TicketBAIBundle\Entity\IDOtro;

/**
 * Class to define TicketBAI system 'PersonaOEntidadDesarrolladora' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 * @Assert\GroupSequenceProvider
 *
 */
class PersonaOEntidadDesarrolladora implements GroupSequenceProviderInterface
{
    /**
     * NIF de la persona o entidad desarrolladora.
     * Dato asociado a la inscripción en el Registro de Software TicketBAI.
     *
     * Formato:             FormatoNIF(9)
     * Obligatorio:         Sí
     * Campo excluyente:    IDOtro
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank(groups={"isNational"})
     * @Assert\Type(type="alnum")
     * @Assert\Length(
     *      min = 9,
     *      max = 9
     * )
     * @Assert\Regex("/^[0-9]{8}[A-Z]$/")
     */
    private string $NIF;

    /**
     * Obligatorio:         Sí
     * Campo excluyente:    NIF
     *
     * @access  private
     * @var     IDOtro
     *
     * @Assert\NotNull(groups={"isInternational"})
     * @Assert\Type(type="IDOtro")
     * @Assert\Valid
     */
    private IDOtro $IDOtro;

    public function getNIF(): ?string
    {
        return $this->NIF;
    }

    public function setNIF(string $NIF): self
    {
        $this->NIF = $NIF;

        return $this;
    }

    public function getIDOtro(): ?IDOtro
    {
        return $this->IDOtro;
    }

    public function setIDOtro(IDOtro $IDOtro): self
    {
        $this->IDOtro = $IDOtro;

        return $this;
    }

    public function getGroupSequence()
    {
        return [
            'PersonaOEntidadDesarrolladora',
            $this->getIDOtro() ? 'isInternational' : 'isNational'
        ];
    }
}