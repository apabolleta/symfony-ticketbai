<?php

namespace APM\TicketBAIBundle\Signer;

use APM\TicketBAIBundle\SignerInterface;

/**
 * Class to handle XML signer.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class XMLSigner implements SignerInterface
{
    /**
     * Flag to set custom UID.
     *
     * If set to null, self-generated value is used.
     */
    const UID = 'uid';

    /**
     * Flag to set signature policy identifier.
     */
    const SIGNATURE_POLICY_IDENTIFIER = 'signature_policy_identifier';

    /**
     * Flag to set signature policy URI.
     */
    const SIGNATURE_POLICY_URI = 'signature_policy_uri';

    /**
     * Flag to set signature policy digest.
     */
    const SIGNATURE_POLICY_DIGEST = 'signature_policy_digest';

    /**
     * Default signer context.
     */
    private $defaultContext = [
        self::UID => null
    ];

    private $private_key;
    private $certificate;
    private $certificate_chain;

    public function __construct(string $private_key, string $certificate, array $certificate_chain = [])
    {
        if (!\openssl_x509_check_private_key($certificate, $private_key)) {
            throw new \Exception("Private key does not correspond to given certificate.");
        }

        $this->private_key = $private_key;
        $this->certificate = $certificate;
        $this->certificate_chain = $certificate_chain;
    }

    public function sign(string $data, string $format = null, array $context = []): string
    {
        $context = \array_merge($this->defaultContext, $context);  # Get context

        $doc = new \DOMDocument();
        if (!$doc->loadXML($data)) {
            throw new \InvalidArgumentException("Argument provided must contain valid XML data.");
        }

        $root = $doc->documentElement;

        $uid = $context[self::UID] ?? \uniqid();

        /* --------- */
        /* ds:Object */
        /* --------- */
        $object = $doc->createElement("ds:Object");

        # xades:QualifyingProperties
        $qualifyingProperties = $doc->createElement("xades:QualifyingProperties");
        $qualifyingProperties->setAttributeNS("http://www.w3.org/2000/xmlns/", "xmlns:xades", "http://uri.etsi.org/01903/v1.3.2#");
        $qualifyingProperties->setAttributeNS("http://www.w3.org/2000/xmlns/", "xmlns:ds", "http://www.w3.org/2000/09/xmldsig#");
        $qualifyingProperties->setAttribute("Id", "QualifyingProperties-" . $uid);
        $qualifyingProperties->setAttribute("Target", "Signature-" . $uid);

        ## xades:SignedProperties
        $signedProperties = $doc->createElement("xades:SignedProperties");
        $signedProperties->setAttribute("Id", "SignedProperties-" . $uid);

        ### xades:SignedSignatureProperties
        $signedSignatureProperties = $doc->createElement("xades:SignedSignatureProperties");

        #### xades:SigningTime
        $signingTime = $doc->createElement("xades:SigningTime");
        $signingTime->nodeValue = \date(DATE_W3C);

        $signedSignatureProperties->appendChild($signingTime);

        #### xades:SigningCertificate
        $signingCertificate = $doc->createElement("xades:SigningCertificate");

        ##### xades:Cert
        $cert = $doc->createElement("xades:Cert");

        ###### xades:CertDigest
        $certDigest = $doc->createElement("xades:CertDigest");

        ####### ds:DigestMethod
        $digestMethod = $doc->createElement("ds:DigestMethod");
        $digestMethod->setAttribute("Algorithm", "http://www.w3.org/2001/04/xmlenc#sha512");

        $certDigest->appendChild($digestMethod);

        ####### ds:DigestValue
        $digestValue = $doc->createElement("ds:DigestValue");
        $digestValue->nodeValue = \base64_encode(\openssl_x509_fingerprint($this->certificate, "sha512", true));

        $certDigest->appendChild($digestValue);

        $cert->appendChild($certDigest);

        ###### xades:IssuerSerial
        $issuerSerial = $doc->createElement("xades:IssuerSerial");

        ####### ds:X509IssuerName
        $X509IssuerName = $doc->createElement("ds:X509IssuerName");
        $X509IssuerName->nodeValue = \urldecode(\http_build_query(\array_reverse(\openssl_x509_parse($this->certificate)["issuer"]), "", ", "));

        $issuerSerial->appendChild($X509IssuerName);

        ####### ds:X509SerialNumber
        $X509SerialNumber = $doc->createElement("ds:X509SerialNumber");
        $X509SerialNumber->nodeValue = \openssl_x509_parse($this->certificate)["serialNumber"];

        $issuerSerial->appendChild($X509SerialNumber);

        $cert->appendChild($issuerSerial);

        $signingCertificate->appendChild($cert);

        $signedSignatureProperties->appendChild($signingCertificate);

        #### xades:SignaturePolicyIdentifier
        $signaturePolicyIdentifier = $doc->createElement("xades:SignaturePolicyIdentifier");

        ##### xades:SignaturePolicyId
        $signaturePolicyId = $doc->createElement("xades:SignaturePolicyId");

        if (isset($context[self::SIGNATURE_POLICY_IDENTIFIER])) {
            ###### xades:SigPolicyId
            $sigPolicyId = $doc->createElement("xades:SigPolicyId");

            ####### xades:Identifier
            $identifier = $doc->createElement("xades:Identifier");
            $identifier->nodeValue = $context[self::SIGNATURE_POLICY_IDENTIFIER];

            $sigPolicyId->appendChild($identifier);

            ####### xades:Description
            $description = $doc->createElement("xades:Description");

            $sigPolicyId->appendChild($description);

            $signaturePolicyId->appendChild($sigPolicyId);
        }

        if (isset($context[self::SIGNATURE_POLICY_DIGEST])) {
            ###### xades:SigPolicyHash
            $sigPolicyHash = $doc->createElement("xades:SigPolicyHash");

            ####### ds:DigestMethod
            $digestMethod = $doc->createElement("ds:DigestMethod");
            $digestMethod->setAttribute("Algorithm", "http://www.w3.org/2001/04/xmlenc#sha256");

            $sigPolicyHash->appendChild($digestMethod);

            ####### ds:DigestValue
            $digestValue = $doc->createElement("ds:DigestValue");
            $digestValue->nodeValue = $context[self::SIGNATURE_POLICY_DIGEST];

            $sigPolicyHash->appendChild($digestValue);

            $signaturePolicyId->appendChild($sigPolicyHash);
        }

        if (isset($context[self::SIGNATURE_POLICY_URI])) {
            ###### xades:SigPolicyQualifiers
            $sigPolicyQualifiers = $doc->createElement("xades:SigPolicyQualifiers");

            ####### xades:SigPolicyQualifier
            $sigPolicyQualifier = $doc->createElement("xades:SigPolicyQualifier");

            ######## xades:SPURI
            $spuri = $doc->createElement("xades:SPURI");
            $spuri->nodeValue = $context[self::SIGNATURE_POLICY_URI];

            $sigPolicyQualifier->appendChild($spuri);

            $sigPolicyQualifiers->appendChild($sigPolicyQualifier);

            $signaturePolicyId->appendChild($sigPolicyQualifiers);
        }

        $signaturePolicyIdentifier->appendChild($signaturePolicyId);

        $signedSignatureProperties->appendChild($signaturePolicyIdentifier);

        $signedProperties->appendChild($signedSignatureProperties);

        ### xades:SignedDataObjectProperties
        $signedDataObjectProperties = $doc->createElement("xades:SignedDataObjectProperties");

        #### xades:DataObjectFormat
        $dataObjectFormat = $doc->createElement("xades:DataObjectFormat");
        $dataObjectFormat->setAttribute("ObjectReference", "#Reference-" . $uid);

        ##### xades:Description
        $description = $doc->createElement("xades:Description");

        $dataObjectFormat->appendChild($description);

        ##### xades:ObjectIdentifier
        $objectIdentifier = $doc->createElement("xades:ObjectIdentifier");

        ###### xades:Identifier
        $identifier = $doc->createElement("xades:Identifier");
        $identifier->setAttribute("Qualifier", "OIDAsURN");
        $identifier->nodeValue = "urn:oid:1.2.840.10003.5.109.10";

        $objectIdentifier->appendChild($identifier);

        ###### xades:Description
        $description = $doc->createElement("xades:Description");

        $objectIdentifier->appendChild($description);

        $dataObjectFormat->appendChild($objectIdentifier);

        ##### xades:MimeType
        $mimeType = $doc->createElement("xades:MimeType");
        $mimeType->nodeValue = "text/xml";

        $dataObjectFormat->appendChild($mimeType);

        ##### xades:Encoding
        $encoding = $doc->createElement("xades:Encoding");

        $dataObjectFormat->appendChild($encoding);

        $signedDataObjectProperties->appendChild($dataObjectFormat);

        $signedProperties->appendChild($signedDataObjectProperties);

        $qualifyingProperties->appendChild($signedProperties);

        $object->appendChild($qualifyingProperties);

        /* ---------- */
        /* ds:KeyInfo */
        /* ---------- */
        $keyInfo = $doc->createElement("ds:KeyInfo");
        $keyInfo->setAttribute("Id", "KeyInfo-" . $uid);

        # ds:X509Data
        $X509Data = $doc->createElement("ds:X509Data");

        ## ds:X509Certificate (Signer certificate)
        $X509Certificate = $doc->createElement("ds:X509Certificate");
        $X509Certificate->nodeValue = \str_replace(["-----BEGIN CERTIFICATE-----", "-----END CERTIFICATE-----", "\r", "\n"], "", $this->certificate);

        $X509Data->appendChild($X509Certificate);

        ## ds:X509Certificate (Extra certificates)
        foreach ($this->certificate_chain as $certificate) {
            $X509Certificate = $doc->createElement("ds:X509Certificate");
            $X509Certificate->nodeValue = \str_replace(["-----BEGIN CERTIFICATE-----", "-----END CERTIFICATE-----", "\r", "\n"], "", $certificate);

            $X509Data->appendChild($X509Certificate);
        }

        $keyInfo->appendChild($X509Data);

        # ds:KeyValue
        $keyValue = $doc->createElement("ds:KeyValue");

        $publicKey = \openssl_pkey_get_details(\openssl_pkey_get_public($this->certificate));
        if ($publicKey["type"] == OPENSSL_KEYTYPE_RSA) {
            ## ds:RSAKeyValue
            $RSAKeyValue = $doc->createElement("ds:RSAKeyValue");

            ### ds:Modulus
            $modulus = $doc->createElement("ds:Modulus");
            $modulus->nodeValue = \base64_encode($publicKey["rsa"]["n"]);

            $RSAKeyValue->appendChild($modulus);

            ### ds:Exponent
            $exponent = $doc->createElement("ds:Exponent");
            $exponent->nodeValue = \base64_encode($publicKey["rsa"]["e"]);

            $RSAKeyValue->appendChild($exponent);

            $keyValue->appendChild($RSAKeyValue);
        } else if ($publicKey["type"] == OPENSSL_KEYTYPE_DSA) {
            ## ds:DSAKeyValue
            $DSAKeyValue = $doc->createElement("ds:DSAKeyValue");

            ### ds:P
            $p = $doc->createElement("ds:P");
            $p->nodeValue = \base64_encode($publicKey["dsa"]["p"]);

            $DSAKeyValue->appendChild($p);

            ### ds:Q
            $q = $doc->createElement("ds:Q");
            $q->nodeValue = \base64_encode($publicKey["dsa"]["q"]);

            $DSAKeyValue->appendChild($q);

            ### ds:G
            $g = $doc->createElement("ds:G");
            $g->nodeValue = \base64_encode($publicKey["dsa"]["g"]);

            $DSAKeyValue->appendChild($g);

            ### ds:Y
            $y = $doc->createElement("ds:Y");
            $y->nodeValue = \base64_encode($publicKey["dsa"]["pub_key"]);

            $DSAKeyValue->appendChild($y);

            $keyValue->appendChild($DSAKeyValue);
        } else if ($publicKey["type"] == OPENSSL_KEYTYPE_EC) {
            ## dsig11:ECKeyValue
            $ECKeyValue = $doc->createElement("dsig11:ECKeyValue");
            $ECKeyValue->setAttributeNS("http://www.w3.org/2000/xmlns/", "xmlns:dsig11", "http://www.w3.org/2009/xmldsig11#");

            ### dsig11:NamedCurve
            $namedCurve = $doc->createElement("dsig11:NamedCurve");
            $namedCurve->setAttribute("URI", "urn:oid:" . $publicKey["ec"]["curve_oid"]);

            $ECKeyValue->appendChild($namedCurve);

            ### dsig11:PublicKey
            $ECPublicKey = $doc->createElement("dsig11:PublicKey");
            $ECPublicKey->nodeValue = \str_replace(["-----BEGIN CERTIFICATE-----", "-----END CERTIFICATE-----", "\r", "\n"], "", $publicKey["key"]);

            $ECKeyValue->appendChild($ECPublicKey);

            $keyValue->appendChild($ECKeyValue);
        } else {
            throw new \Exception("Public key type not supported.");
        }

        $keyInfo->appendChild($keyValue);

        /* ------------- */
        /* ds:SignedInfo */
        /* ------------- */
        $signedInfo = $doc->createElement("ds:SignedInfo");

        # ds:CanonicalizationMethod (C14N)
        $canonicalizationMethod = $doc->createElement("ds:CanonicalizationMethod");
        $canonicalizationMethod->setAttribute("Algorithm", "http://www.w3.org/TR/2001/REC-xml-c14n-20010315");

        $signedInfo->appendChild($canonicalizationMethod);

        # ds:SignatureMethod (RSA-SHA256)
        $signatureMethod = $doc->createElement("ds:SignatureMethod");
        $signatureMethod->setAttribute("Algorithm", "http://www.w3.org/2001/04/xmldsig-more#rsa-sha256");

        $signedInfo->appendChild($signatureMethod);

        # ds:Reference
        $reference = $doc->createElement("ds:Reference");
        $reference->setAttribute("Id", "Reference-" . $uid);
        $reference->setAttribute("URI", "");

        ## ds:Transforms
        $transforms = $doc->createElement("ds:Transforms");

        ### ds:Transform
        $transform = $doc->createElement("ds:Transform");
        $transform->setAttribute("Algorithm", "http://www.w3.org/TR/2001/REC-xml-c14n-20010315");

        $transforms->appendChild($transform);

        ### ds:Transform
        $transform = $doc->createElement("ds:Transform");
        $transform->setAttribute("Algorithm", "http://www.w3.org/2000/09/xmldsig#enveloped-signature");

        $transforms->appendChild($transform);

        ### ds:Transform
        $transform = $doc->createElement("ds:Transform");
        $transform->setAttribute("Algorithm", "http://www.w3.org/TR/1999/REC-xpath-19991116");

        #### ds:XPath
        $XPath = $doc->createElement("ds:XPath");
        $XPath->setAttributeNS("http://www.w3.org/2000/xmlns/", "xmlns:ds", "http://www.w3.org/2000/09/xmldsig#");
        $XPath->nodeValue = "not(ancestor-or-self::ds:Signature)";

        $transform->appendChild($XPath);

        $transforms->appendChild($transform);

        $reference->appendChild($transforms);

        ## ds:DigestMethod
        $digestMethod = $doc->createElement("ds:DigestMethod");
        $digestMethod->setAttribute("Algorithm", "http://www.w3.org/2001/04/xmlenc#sha512");

        $reference->appendChild($digestMethod);

        ## ds:DigestValue
        $digestValue = $doc->createElement("ds:DigestValue");
        $digestValue->nodeValue = \base64_encode(\hash("sha512", $root->C14N(), true));

        $reference->appendChild($digestValue);

        $signedInfo->appendChild($reference);

        # ds:Reference
        $reference = $doc->createElement("ds:Reference");
        $reference->setAttribute("Type", "http://uri.etsi.org/01903#SignedProperties");
        $reference->setAttribute("URI", "#SignedProperties-" . $uid);

        ## ds:DigestMethod
        $digestMethod = $doc->createElement("ds:DigestMethod");
        $digestMethod->setAttribute("Algorithm", "http://www.w3.org/2001/04/xmlenc#sha512");

        $reference->appendChild($digestMethod);

        ## ds:DigestValue
        $digestValue = $doc->createElement("ds:DigestValue");
        $digestValue->nodeValue = \base64_encode(\hash("sha512", $signedProperties->C14N(), true));

        $reference->appendChild($digestValue);

        $signedInfo->appendChild($reference);

        # ds:Reference
        $reference = $doc->createElement("ds:Reference");
        $reference->setAttribute("URI", "#KeyInfo-" . $uid);

        ## ds:DigestMethod
        $digestMethod = $doc->createElement("ds:DigestMethod");
        $digestMethod->setAttribute("Algorithm", "http://www.w3.org/2001/04/xmlenc#sha512");

        $reference->appendChild($digestMethod);

        ## ds:DigestValue
        $digestValue = $doc->createElement("ds:DigestValue");
        $digestValue->nodeValue = \base64_encode(\hash("sha512", $keyInfo->C14N(), true));

        $reference->appendChild($digestValue);

        $signedInfo->appendChild($reference);

        \openssl_sign($signedInfo->C14N(), $signature, \openssl_pkey_get_private($this->private_key), OPENSSL_ALGO_SHA256);

        /* ----------------- */
        /* ds:SignatureValue */
        /* ----------------- */
        $signatureValue = $doc->createElement("ds:SignatureValue");
        $signatureValue->setAttribute("Id", "SignatureValue-" . $uid);
        $signatureValue->nodeValue = \base64_encode($signature);

        /* ************ */
        /* ds:Signature */
        /* ************ */
        $signature = $doc->createElement("ds:Signature");
        $signature->setAttribute("Id", "Signature-" . $uid);
        $signature->setAttributeNS("http://www.w3.org/2000/xmlns/", "xmlns:ds", "http://www.w3.org/2000/09/xmldsig#");

        $signature->appendChild($signedInfo);      # ds:SignedInfo
        $signature->appendChild($signatureValue);  # ds:SignatureValue
        $signature->appendChild($keyInfo);         # ds:KeyInfo
        $signature->appendChild($object);          # ds:Object

        # Insert signature
        $root->appendChild($signature);

        if (!$xml = $doc->saveXML()) {
            throw new \RuntimeException("Unable to sign XML data.");
        }

        return $xml;
    }

    public function verify(string $data): bool
    {
        throw new \BadMethodCallException("Method " . __METHOD__ . " not implemented.");
    }
}