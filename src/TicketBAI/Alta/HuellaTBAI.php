<?php

namespace APM\TicketBAIBundle\TicketBAI\Alta;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\StructureInterface;
use APM\TicketBAIBundle\TicketBAI\Alta\EncadenamientoFacturaAnterior;
use APM\TicketBAIBundle\TicketBAI\Alta\SoftwareTicketBAI;

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
     * Obligatorio:         No
     *
     * @access  private
     * @var     EncadenamientoFacturaAnterior
     *
     * @Assert\Type(type=EncadenamientoFacturaAnterior::class)
     * @Assert\Valid
     */
    private EncadenamientoFacturaAnterior $EncadenamientoFacturaAnterior;

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
    private SoftwareTicketBAI $SoftwareTicketBAI;

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

    public function getEncadenamientoFacturaAnterior(): ?EncadenamientoFacturaAnterior
    {
        return $this->EncadenamientoFacturaAnterior;
    }

    public function setEncadenamientoFacturaAnterior(EncadenamientoFacturaAnterior $EncadenamientoFacturaAnterior): self
    {
        $this->EncadenamientoFacturaAnterior = $EncadenamientoFacturaAnterior;

        return $this;
    }

    public function getSoftwareTicketBAI(): SoftwareTicketBAI
    {
        return $this->SoftwareTicketBAI;
    }

    public function setSoftwareTicketBAI(SoftwareTicketBAI $SoftwareTicketBAI): self
    {
        $this->SoftwareTicketBAI = $SoftwareTicketBAI;

        return $this;
    }

    public function getNumSerieDispositivo(): ?string
    {
        return $this->NumSerieDispositivo;
    }

    public function setNumSerieDispositivo(string $NumSerieDispositivo): self
    {
        $this->NumSerieDispositivo = $NumSerieDispositivo;

        return $this;
    }
}