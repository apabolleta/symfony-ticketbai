<?php

namespace APM\TicketBAIBundle\TicketBAI;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class to define TicketBAI 'ResultadoValidacion' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class ResultadoValidacion
{
    private string $Codigo;

    private string $Descripcion;

    private string $Azalpena;
}