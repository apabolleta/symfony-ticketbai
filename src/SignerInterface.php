<?php

namespace APM\TicketBAIBundle;

/**
 * Interface definition for TicketBAIBundle Signer.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
interface SignerInterface
{
    public function sign();
    public function verify();
}