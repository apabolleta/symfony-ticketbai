<?php

namespace APM\TicketBAIBundle\Signature;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class to define TicketBAI 'Signature' structure.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class Signature
{
    private $SignedInfo;

    private $SignatureValue;

    private $KeyInfo;

    private $Object;
}