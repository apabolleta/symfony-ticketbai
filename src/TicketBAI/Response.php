<?php

namespace APM\TicketBAIBundle\TicketBAI;

use Symfony\Component\Validator\Constraints as Assert;

use APM\TicketBAIBundle\StructureInterface;

/**
 * Class to define TicketBAI 'Response' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class Response implements StructureInterface
{
    private string $IdentificadorTBAI;

    private string $FechaRecepcion;

    private string $Estado;

    private string $Descripcion;

    private string $Azalpena;

    private array $ResultadosValidacion;

    private string $CSV;
}