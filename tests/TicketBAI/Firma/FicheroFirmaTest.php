<?php declare(strict_types=1);

namespace APM\TicketBAIBundle\Tests\TicketBAI\Firma;

use APM\TicketBAIBundle\Tests\EntityValidationTestCase;
use APM\TicketBAIBundle\TicketBAI\Firma\Signer;
/**
 * Class to perform TicketBAI 'FicheroAnulacion' structure validation tests.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
final class FicheroFirmaTest extends EntityValidationTestCase
{
    public function testValidFicheroAnulacion(): void
    {
        $signer = new Signer();
        $signer->loadPkcs12("p.12.file_location", "p.12.file.passwd");

        $xml = file_get_contents('resource/ejemplo_tbai_sin_firma.xml');

        $xml_firmaute = $signer->sign($xml);

        file_put_contents('resource/ejemplo_tbai_con_firma.xml', $xml_firmaute);

        self::assertTrue(true);

    }

}