<?php

namespace APM\TicketBAIBundle\Exception;

/**
 * Class for InvalidDataException.
 *
 * Exception thrown when invalid data is provided by the user.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class InvalidDataException extends \Exception {}

/**
 * Class for InvalidSignatureException.
 *
 * Exception thrown when signature check fails.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class InvalidSignatureException extends \Exception {}