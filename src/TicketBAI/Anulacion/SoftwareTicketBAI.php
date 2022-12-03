<?php

namespace APM\TicketBAIBundle\TicketBAI\Anulacion;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\StructureInterface;
use APM\TicketBAIBundle\TicketBAI\Anulacion\PersonaOEntidadDesarrolladora;

/**
 * Class to define TicketBAI 'SoftwareTicketBAI' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class SoftwareTicketBAI implements StructureInterface
{
    /**
     * Número de alta-inscripción asignado por la Administración tributaria en el Registro de Software TicketBAI.
     *
     * (Número de Alta Inscripción)
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
     */
    private string $LicenciaTBAI;

    /**
     * Obligatorio:     Sí
     *
     * @access  private
     * @var     PersonaOEntidadDesarrolladora
     *
     * @Assert\NotNull
     * @Assert\Type(type=PersonaOEntidadDesarrolladora::class)
     * @Assert\Valid
     */
    private PersonaOEntidadDesarrolladora $EntidadDesarrolladora;

    /**
     * Nombre del software TicketBAI.
     *
     * Dato asociado a la inscripción en el Registro de Software TicketBAI.
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
    private string $Nombre;

    /**
     * Identificación de la versión del Software TicketBAI utilizado.
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
     */
    private string $Version;

    public function getLicenciaTBAI(): string
    {
        return $this->LicenciaTBAI;
    }

    public function setLicenciaTBAI(string $LicenciaTBAI): self
    {
        $this->LicenciaTBAI = $LicenciaTBAI;

        return $this;
    }

    public function getPersonaOEntidadDesarrolladora(): PersonaOEntidadDesarrolladora
    {
        return $this->EntidadDesarrolladora;
    }

    public function setPersonaOEntidadDesarrolladora(PersonaOEntidadDesarrolladora $PersonaOEntidadDesarrolladora): self
    {
        $this->EntidadDesarrolladora = $PersonaOEntidadDesarrolladora;

        return $this;
    }

    public function getNombre(): string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getVersion(): string
    {
        return $this->Version;
    }

    public function setVersion(string $Version): self
    {
        $this->Version = $Version;

        return $this;
    }
}