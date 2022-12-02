<?php

namespace APM\TicketBAIBundle\TicketBAI\Alta;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\StructureInterface;
use APM\TicketBAIBundle\TicketBAI\TicketBAI;
use APM\TicketBAIBundle\TicketBAI\Alta\ImporteRectificacionSustitutiva;

/**
 * Class to define TicketBAI 'FacturaRectificativa' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class FacturaRectificativa implements StructureInterface
{
    /**
     * Código que identifica el tipo de factura rectificativa.
     *
     * Formato:             Alfanumérico(2)
     * Valores posibles:    L7
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
     * @Assert\Choice(choices=TicketBAI::L7_Codigo)
     */
    private string $Codigo;

    /**
     * Identifica si el tipo de factura rectificativa es por sustitución o por diferencias.
     *
     * Formato:             Alfanumérico(1)
     * Valores posibles:    L8
     * Obligatorio:         Sí
     *
     * @access  private
     * @var     string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min = 1,
     *      max = 1
     * )
     * @Assert\Choice(choices=TicketBAI::L8_Tipo)
     */
    private string $Tipo;

    /**
     * Obligatorio:         No
     *
     * @access  private
     * @var     ImporteRectificacionSustitutiva
     *
     * @Assert\Type(type=ImporteRectificacionSustitutiva::class)
     * @Assert\Valid
     */
    private ImporteRectificacionSustitutiva $ImporteRectificacionSustitutiva;

    public function getCodigo(): string
    {
        return $this->Codigo;
    }

    public function setCodigo(string $Codigo): self
    {
        $this->Codigo = $Codigo;

        return $this;
    }

    public function getTipo(): string
    {
        return $this->Tipo;
    }

    public function setTipo(string $Tipo): self
    {
        $this->Tipo = $Tipo;

        return $this;
    }

    public function getImporteRectificacionSustitutiva(): ImporteRectificacionSustitutiva
    {
        return $this->ImporteRectificacionSustitutiva;
    }

    public function setImporteRectificacionSustitutiva(ImporteRectificacionSustitutiva $ImporteRectificacionSustitutiva): self
    {
        $this->ImporteRectificacionSustitutiva = $ImporteRectificacionSustitutiva;

        return $this;
    }
}