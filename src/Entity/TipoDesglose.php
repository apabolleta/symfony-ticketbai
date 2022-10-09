<?php

namespace APM\TicketBAIBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\Entity\DesgloseFactura;
use APM\TicketBAIBundle\Entity\DesgloseTipoOperacion;

/**
 * Class to define TicketBAI system 'TipoDesglose' structure.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class TipoDesglose
{
    /**
     * Cuando la contraparte es un “nacional” o no existe contraparte.
     *
     * Obligatorio:         Sí
     * Campo excluyente:    DesgloseTipoOperacion
     *
     * @access  private
     * @var     DesgloseFactura
     *
     * @Assert\NotNull(groups={"isNational"})
     * @Assert\Type(type="DesgloseFactura")
     * @Assert\Valid
     */
    private DesgloseFactura $DesgloseFactura;

    /**
     * Cuando la contraparte es no nacional.
     *
     * Obligatorio:         Sí
     * Campo excluyente:    DesgloseFactura
     *
     * @access  private
     * @var     DesgloseTipoOperacion
     *
     * @Assert\NotNull(groups={"isNoNational"})
     * @Assert\Type(type="DesgloseTipoOperacion")
     * @Assert\Valid
     */
    private DesgloseTipoOperacion $DesgloseTipoOperacion;

    public function getDesgloseFactura(): ?DesgloseFactura
    {
        return $this->DesgloseFactura;
    }

    public function setDesgloseFactura(DesgloseFactura $DesgloseFactura): self
    {
        $this->DesgloseFactura = $DesgloseFactura;

        return $this;
    }

    public function getDesgloseTipoOperacion(): ?DesgloseTipoOperacion
    {
        return $this->DesgloseTipoOperacion;
    }

    public function setDesgloseTipoOperacion(DesgloseTipoOperacion $DesgloseTipoOperacion): self
    {
        $this->DesgloseTipoOperacion = $DesgloseTipoOperacion;

        return $this;
    }
}