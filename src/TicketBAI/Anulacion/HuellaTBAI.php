<?php

namespace APM\TicketBAIBundle\TicketBAI\Anulacion;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\StructureInterface;
use APM\TicketBAIBundle\TicketBAI\Anulacion\SoftwareTicketBAI;

/**
 * Class to define TicketBAI 'HuellaTBAI' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class HuellaTBAI implements StructureInterface
{
    /**
     * Obligatorio:         Sí
     *
     * @access  private
     * @var     SoftwareTicketBAI
     *
     * @Assert\NotNull
     * @Assert\Type(type=SoftwareTicketBAI::class)
     * @Assert\Valid
     */
    private SoftwareTicketBAI $Software;

    /**
     * Número de serie del dispositivo de facturación utilizado.
     *
     * Formato:             Alfanumérico(30)
     * Obligatorio:         No
     *
     * @access  private
     * @var     string
     *
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      max = 30
     * )
     */
    private string $NumSerieDispositivo;

    public function getSoftwareTicketBAI(): SoftwareTicketBAI
    {
        return $this->Software;
    }

    public function setSoftwareTicketBAI(SoftwareTicketBAI $SoftwareTicketBAI): self
    {
        $this->Software = $SoftwareTicketBAI;

        return $this;
    }

    public function getNumSerieDispositivo(): string
    {
        return $this->NumSerieDispositivo;
    }

    public function setNumSerieDispositivo(string $NumSerieDispositivo): self
    {
        $this->NumSerieDispositivo = $NumSerieDispositivo;

        return $this;
    }
}