<?php

namespace APM\TicketBAIBundle\Exception;

/**
 * Class for InvalidDataException.
 *
 * Exception thrown when invalid data is provided by the user.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class InvalidDataException extends \Exception {}

/**
 * Class for InvalidSignatureException.
 *
 * Exception thrown when signature check fails.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class InvalidSignatureException extends \Exception {}