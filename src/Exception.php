<?php

namespace APM\TicketBAIBundle\Exception;

/**
 * Class for ValidationFailedException.
 *
 * Exception thrown when validation fails.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class ValidationFailedException extends \Exception {}

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