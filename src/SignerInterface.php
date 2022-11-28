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
    /**
     * Computes the signature and returns signed data.
     *
     * @param   string  $data  Unsigned data.
     * @return  string         Signed data.
     */
    public function sign(string $data): string;

    /**
     * Extracts and checks signature of signed data.
     *
     * @param   string  $data  Signed data.
     * @return  bool           Returns true if the signature is correct. Otherwise, returns false.
     */
    public function verify(string $data): bool;
}