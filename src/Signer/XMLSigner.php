<?php

namespace APM\TicketBAIBundle\Signer;

use APM\TicketBAIBundle\SignerInterface;

/**
 * Class to handle XMLSigner.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class XMLSigner implements SignerInterface
{
    /**
     * Flag to set XMLDsig namespace.
     */
    const XML_NS_DS = 'xml_ns_ds';

    /**
     * Flag to set XMLDsig namespace URI.
     */
    const XML_NS_DS_URI = 'xml_ns_ds_uri';

    /**
     * Flag to set signature node name.
     */
    const XML_SIGNATURE_NODE_NAME = 'xml_signature_node_name';

    /**
     * Default signer context.
     */
    private $defaultContext = [
        self::XML_NS_DS => "ds",
        self::XML_NS_DS_URI => "http://www.w3.org/2000/09/xmldsig#",
        self::XML_SIGNATURE_NODE_NAME => "Signature"
    ];

    public function sign(string $data, string $format = null, array $context = []): string
    {
        $context = \array_merge($this->defaultContext, $context);  # Get context

        $doc = \DOMDocument::loadXML($data);
        if (false == $doc) {
            throw new \InvalidArgumentException("Argument data provided must be valid XML.");
        }

        $root = $doc->documentElement;

        $signature = $doc->createElementNS($context[self::XML_NS_DS_URI], $context[self::XML_NS_DS] . ":" . $context[self::XML_SIGNATURE_NODE_NAME]);

        $root->appendChild($signature);

        # TODO: Build Signature element

        $xml = $doc->saveXML();
        if (false == $xml) {
            throw new \RuntimeException("Unable to sign XML data.");
        }

        return $xml;
    }

    public function verify(string $data): bool
    {
        throw new \BadMethodCallException("Method " . __METHOD__ . " not implemented.");
    }
}