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
    /* XML namespaces */
    const XML_NS_XMLNS     = "xmlns";
    const XML_NS_XMLDSIG   = "ds";
    const XML_NS_XMLDSIG11 = "dsig11";
    const XML_NS_XADES     = "xades";

    const XML_NS_URIS = [
        self::XML_NS_XMLNS     => "http://www.w3.org/2000/xmlns/",
        self::XML_NS_XMLDSIG   => "http://www.w3.org/2000/09/xmldsig#",
        self::XML_NS_XMLDSIG11 => "http://www.w3.org/2009/xmldsig11#",
        self::XML_NS_XADES     => "http://uri.etsi.org/01903/v1.3.2#"
    ];

    /* Digest algorithms */
    const SHA1   = "sha1";
    const SHA224 = "sha224";
    const SHA256 = "sha256";
    const SHA384 = "sha384";
    const SHA512 = "sha512";

    const DIGEST_ALGORITHMS_URIS = [
        self::SHA1   => "http://www.w3.org/2000/09/xmldsig#sha1",
        self::SHA224 => "http://www.w3.org/2001/04/xmldsig-more#sha224",
        self::SHA256 => "http://www.w3.org/2001/04/xmlenc#sha256",
        self::SHA384 => "http://www.w3.org/2001/04/xmldsig-more#sha384",
        self::SHA512 => "http://www.w3.org/2001/04/xmlenc#sha512"
    ];

    /* Encoding algorithms */
    const BASE64 = "base64";

    const ENCODING_ALGORITHMS_URIS = [
        self::BASE64 => "http://www.w3.org/2000/09/xmldsig#base64"
    ];

    /* MAC algorithms */
    const HMAC_SHA1   = "hmac-sha1";
    const HMAC_SHA224 = "hmac-sha224";
    const HMAC_SHA256 = "hmac-sha256";
    const HMAC_SHA384 = "hmac-sha384";
    const HMAC_SHA512 = "hmac-sha512";

    const MAC_ALGORITHMS_URIS = [
        self::HMAC_SHA1   => "http://www.w3.org/2000/09/xmldsig#hmac-sha1",
        self::HMAC_SHA224 => "http://www.w3.org/2001/04/xmldsig-more#hmac-sha224",
        self::HMAC_SHA256 => "http://www.w3.org/2001/04/xmldsig-more#hmac-sha256",
        self::HMAC_SHA384 => "http://www.w3.org/2001/04/xmldsig-more#hmac-sha384",
        self::HMAC_SHA512 => "http://www.w3.org/2001/04/xmldsig-more#hmac-sha512"
    ];

    /* Signature algorithms */
    const RSA_SHA1     = "rsa-sha1";
    const RSA_SHA224   = "rsa-sha224";
    const RSA_SHA256   = "rsa-sha256";
    const RSA_SHA384   = "rsa-sha384";
    const RSA_SHA512   = "rsa-sha512";
    const ECDSA_SHA1   = "ecdsa-sha1";
    const ECDSA_SHA224 = "ecdsa-sha224";
    const ECDSA_SHA256 = "ecdsa-sha256";
    const ECDSA_SHA384 = "ecdsa-sha384";
    const ECDSA_SHA512 = "ecdsa-sha512";
    const DSA_SHA1     = "dsa-sha1";
    const DSA_SHA256   = "dsa-sha256";

    const SIGNATURE_ALGORITHMS_URIS = [
        self::RSA_SHA1     => "http://www.w3.org/2000/09/xmldsig#rsa-sha1",
        self::RSA_SHA224   => "http://www.w3.org/2001/04/xmldsig-more#rsa-sha224",
        self::RSA_SHA256   => "http://www.w3.org/2001/04/xmldsig-more#rsa-sha256",
        self::RSA_SHA384   => "http://www.w3.org/2001/04/xmldsig-more#rsa-sha384",
        self::RSA_SHA512   => "http://www.w3.org/2001/04/xmldsig-more#rsa-sha512",
        self::ECDSA_SHA1   => "http://www.w3.org/2001/04/xmldsig-more#ecdsa-sha1",
        self::ECDSA_SHA224 => "http://www.w3.org/2001/04/xmldsig-more#ecdsa-sha224",
        self::ECDSA_SHA256 => "http://www.w3.org/2001/04/xmldsig-more#ecdsa-sha256",
        self::ECDSA_SHA384 => "http://www.w3.org/2001/04/xmldsig-more#ecdsa-sha384",
        self::ECDSA_SHA512 => "http://www.w3.org/2001/04/xmldsig-more#ecdsa-sha512",
        self::DSA_SHA1     => "http://www.w3.org/2000/09/xmldsig#dsa-sha1",
        self::DSA_SHA256   => "http://www.w3.org/2009/xmldsig11#dsa-sha256"
    ];

    /* Canonicalization algorithms */
    const C14N_OC     = "c14n-oc";
    const C14N_WC     = "c14n-wc";
    const C14N11_OC   = "c14n11-oc";
    const C14N11_WC   = "c14n11-wc";
    const C14N_EXC_OC = "c14n-exc-oc";
    const C14N_EXC_WC = "c14n-exc-wc";

    const CANONICALIZATION_ALGORITHMS_URIS = [
        self::C14N_OC     => "http://www.w3.org/TR/2001/REC-xml-c14n-20010315",
        self::C14N_WC     => "http://www.w3.org/TR/2001/REC-xml-c14n-20010315#WithComments",
        self::C14N11_OC   => "http://www.w3.org/2006/12/xml-c14n11",
        self::C14N11_WC   => "http://www.w3.org/2006/12/xml-c14n11#WithComments",
        self::C14N_EXC_OC => "http://www.w3.org/2001/10/xml-exc-c14n#",
        self::C14N_EXC_WC => "http://www.w3.org/2001/10/xml-exc-c14n#WithComments"
    ];

    /* Transform algorithms */
    # const BASE64              = "base64";
    const ENVELOPED_SIGNATURE = "enveloped-signature";
    const XPATH               = "xpath";
    const XPATH_FILTER_2      = "xpath-filter-2";
    const XSLT                = "xslt";

    const TRANSFORM_ALGORITHMS_URIS = [
        self::BASE64              => "http://www.w3.org/2000/09/xmldsig#base64",
        self::ENVELOPED_SIGNATURE => "http://www.w3.org/2000/09/xmldsig#enveloped-signature",
        self::XPATH               => "http://www.w3.org/TR/1999/REC-xpath-19991116",
        self::XPATH_FILTER_2      => "http://www.w3.org/2002/06/xmldsig-filter2",
        self::XSLT                => "http://www.w3.org/TR/1999/REC-xslt-19991116"
    ];

    /* Signer roles */
    const SIGNER_ROLE_SUPPLIER   = "Supplier";
    const SIGNER_ROLE_CUSTOMER   = "Customer";
    const SIGNER_ROLE_THIRDPARTY = "Thirdparty";

    /* Data object format attributes */
    const DATA_OBJECT_FORMAT_IDENTIFIER = "urn:oid:1.2.840.10003.5.109.10";
    const DATA_OBJECT_FORMAT_MIME_TYPE  = "text/xml";

    /**
     * Flag to set custom UID.
     *
     * If set to null, a self-generated value is used.
     */
    const UID = 'uid';

    /**
     * Flag to set canonicalization method.
     */
    const CANONICALIZATION_METHOD = 'canonicalization_method';

    /**
     * Flag to set signature method.
     */
    const SIGNATURE_METHOD = 'signature_method';

    /**
     * Flag to set signature policy identifier.
     */
    const SIGNATURE_POLICY_IDENTIFIER = 'signature_policy_identifier';

    /**
     * Flag to set signature policy URI.
     */
    const SIGNATURE_POLICY_URI = 'signature_policy_uri';

    /**
     * Flag to set signature policy digest method.
     */
    const SIGNATURE_POLICY_DIGEST_METHOD = 'signature_policy_digest_method';

    /**
     * Flag to set signature policy digest value.
     */
    const SIGNATURE_POLICY_DIGEST_VALUE = 'signature_policy_digest_value';

    /**
     * Flag to set signature production place.
     *
     * Array containing next key names: City, StateOrProvince, PostalCode, CountryName
     */
    const SIGNATURE_PRODUCTION_PLACE = 'signature_production_place';

    /**
     * Flag to set signer role.
     */
    const SIGNER_ROLE = 'signer_role';

    /**
     * Default signer context.
     */
    private $defaultContext = [
        self::UID => null,
        self::CANONICALIZATION_METHOD => self::C14N_OC,
        self::SIGNATURE_METHOD => self::RSA_SHA256
    ];

    private $privateKey;
    private $certificate;
    private $certificateChain;

    public function __construct(string $privateKey, string $certificate, array $certificateChain = [])
    {
        if (!\openssl_x509_check_private_key($certificate, $privateKey)) {
            throw new \Exception("Private key does not correspond to given certificate.");
        }

        $this->privateKey = $privateKey;
        $this->certificate = $certificate;
        $this->certificateChain = $certificateChain;
    }

    public function sign(string $data, string $format = null, array $context = []): string
    {
        $context = \array_merge($this->defaultContext, $context);  # Get context

        $doc = new \DOMDocument();

        $doc->preserveWhiteSpace = true;
        $doc->formatOutput = false;

        if (!$doc->loadXML($data)) {
            throw new \Exception("Argument provided must contain valid XML data.");
        }

        if (!$root = $doc->documentElement) {
            throw new \Exception("XML document element must not be undefined.");
        }

        $uid = $context[self::UID] ?? \uniqid();  # Unique ID

        /* ************ */
        /* ds:Signature */
        /* ************ */
        $dsSignature = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:Signature");
        $dsSignature->setAttribute("Id", "Signature-$uid");

        # ds:SignedInfo
        $dsSignedInfo = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:SignedInfo");
        $dsSignedInfo->setAttribute("Id", "Signature-$uid-SignedInfo");

        $dsSignature->appendChild($dsSignedInfo);

        # ds:SignatureValue
        $dsSignatureValue = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:SignatureValue");
        $dsSignatureValue->setAttribute("Id", "Signature-$uid-SignatureValue");

        $dsSignature->appendChild($dsSignatureValue);

        # ds:KeyInfo
        $dsKeyInfo = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:KeyInfo");
        $dsKeyInfo->setAttribute("Id", "Signature-$uid-KeyInfo");

        $dsSignature->appendChild($dsKeyInfo);

        # ds:Object
        $dsObject = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:Object");
        $dsObject->setAttribute("Id", "Signature-$uid-Object");

        $dsSignature->appendChild($dsObject);

        $root->appendChild($dsSignature);

        /* --------- */
        /* ds:Object */
        /* --------- */
        # xades:QualifyingProperties
        $xadesQualifyingProperties = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:QualifyingProperties");
        $xadesQualifyingProperties->setAttribute("Id", "Signature-$uid-QualifyingProperties");
        $xadesQualifyingProperties->setAttribute("Target", "#Signature-$uid");

        ## xades:SignedProperties
        $xadesSignedProperties = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SignedProperties");
        $xadesSignedProperties->setAttribute("Id", "Signature-$uid-SignedProperties");

        ### xades:SignedSignatureProperties
        $xadesSignedSignatureProperties = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SignedSignatureProperties");

        #### xades:SigningTime
        $xadesSigningTime = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SigningTime");
        $xadesSigningTime->nodeValue = \date(DATE_W3C);

        $xadesSignedSignatureProperties->appendChild($xadesSigningTime);

        #### xades:SigningCertificate
        $xadesSigningCertificate = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SigningCertificate");

        ##### xades:Cert
        $xadesCert = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:Cert");

        ###### xades:CertDigest
        $xadesCertDigest = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:CertDigest");

        ####### ds:DigestMethod
        $dsDigestMethod = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:DigestMethod");
        $dsDigestMethod->setAttribute("Algorithm", self::DIGEST_ALGORITHMS_URIS[self::SHA512]);

        $xadesCertDigest->appendChild($dsDigestMethod);

        ####### ds:DigestValue
        $dsDigestValue = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:DigestValue");
        $dsDigestValue->nodeValue = \base64_encode(\openssl_x509_fingerprint($this->certificate, self::SHA512, true));

        $xadesCertDigest->appendChild($dsDigestValue);

        $xadesCert->appendChild($xadesCertDigest);

        ###### xades:IssuerSerial
        $xadesIssuerSerial = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:IssuerSerial");

        ####### ds:X509IssuerName
        $dsX509IssuerName = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:X509IssuerName");
        $dsX509IssuerName->nodeValue = \urldecode(\http_build_query(\array_reverse(\openssl_x509_parse($this->certificate)["issuer"]), "", ", "));

        $xadesIssuerSerial->appendChild($dsX509IssuerName);

        ####### ds:X509SerialNumber
        $dsX509SerialNumber = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:X509SerialNumber");
        $dsX509SerialNumber->nodeValue = \openssl_x509_parse($this->certificate)["serialNumber"];

        $xadesIssuerSerial->appendChild($dsX509SerialNumber);

        $xadesCert->appendChild($xadesIssuerSerial);

        $xadesSigningCertificate->appendChild($xadesCert);

        $xadesSignedSignatureProperties->appendChild($xadesSigningCertificate);

        #### xades:SignaturePolicyIdentifier
        $xadesSignaturePolicyIdentifier = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SignaturePolicyIdentifier");

        if (isset($context[self::SIGNATURE_POLICY_IDENTIFIER], $context[self::SIGNATURE_POLICY_DIGEST_METHOD], $context[self::SIGNATURE_POLICY_DIGEST_VALUE])) {
            ##### xades:SignaturePolicyId
            $xadesSignaturePolicyId = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SignaturePolicyId");

            ###### xades:SigPolicyId
            $xadesSigPolicyId = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SigPolicyId");

            ####### xades:Identifier
            $xadesIdentifier = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:Identifier");
            $xadesIdentifier->nodeValue = $context[self::SIGNATURE_POLICY_IDENTIFIER];

            $xadesSigPolicyId->appendChild($xadesIdentifier);

            $xadesSignaturePolicyId->appendChild($xadesSigPolicyId);

            ###### xades:SigPolicyHash
            $xadesSigPolicyHash = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SigPolicyHash");

            ####### ds:DigestMethod
            $dsDigestMethod = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:DigestMethod");
            $dsDigestMethod->setAttribute("Algorithm", self::DIGEST_ALGORITHMS_URIS[$context[self::SIGNATURE_POLICY_DIGEST_METHOD]]);

            $xadesSigPolicyHash->appendChild($dsDigestMethod);

            ####### ds:DigestValue
            $dsDigestValue = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:DigestValue");
            $dsDigestValue->nodeValue = $context[self::SIGNATURE_POLICY_DIGEST_VALUE];

            $xadesSigPolicyHash->appendChild($dsDigestValue);

            $xadesSignaturePolicyId->appendChild($xadesSigPolicyHash);

            if (isset($context[self::SIGNATURE_POLICY_URI])) {
                ###### xades:SigPolicyQualifiers
                $xadesSigPolicyQualifiers = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SigPolicyQualifiers");

                ####### xades:SigPolicyQualifier
                $xadesSigPolicyQualifier = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SigPolicyQualifier");

                ######## xades:SPURI
                $xadesSPURI = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SPURI");
                $xadesSPURI->nodeValue = $context[self::SIGNATURE_POLICY_URI];

                $xadesSigPolicyQualifier->appendChild($xadesSPURI);

                $xadesSigPolicyQualifiers->appendChild($xadesSigPolicyQualifier);

                $xadesSignaturePolicyId->appendChild($xadesSigPolicyQualifiers);
            }

            $xadesSignaturePolicyIdentifier->appendChild($xadesSignaturePolicyId);
        } else {
            ##### xades:SignaturePolicyImplied
            $xadesSignaturePolicyImplied = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SignaturePolicyImplied");

            $xadesSignaturePolicyIdentifier->appendChild($xadesSignaturePolicyImplied);
        }

        $xadesSignedSignatureProperties->appendChild($xadesSignaturePolicyIdentifier);

        if (isset($context[self::SIGNATURE_PRODUCTION_PLACE])) {
            $signatureProductionPlace = $context[self::SIGNATURE_PRODUCTION_PLACE];

            #### xades:SignatureProductionPlace
            $xadesSignatureProductionPlace = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SignatureProductionPlace");

            if (isset($signatureProductionPlace["City"])) {
                ##### xades:City
                $xadesCity = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:City");
                $xadesCity->nodeValue = $signatureProductionPlace["City"];

                $xadesSignatureProductionPlace->appendChild($xadesCity);
            }

            if (isset($signatureProductionPlace["StateOrProvince"])) {
                ##### xades:StateOrProvince
                $xadesStateOrProvince = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:StateOrProvince");
                $xadesStateOrProvince->nodeValue = $signatureProductionPlace["StateOrProvince"];

                $xadesSignatureProductionPlace->appendChild($xadesStateOrProvince);
            }

            if (isset($signatureProductionPlace["PostalCode"])) {
                ##### xades:PostalCode
                $xadesPostalCode = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:PostalCode");
                $xadesPostalCode->nodeValue = $signatureProductionPlace["PostalCode"];

                $xadesSignatureProductionPlace->appendChild($xadesPostalCode);
            }

            if (isset($signatureProductionPlace["CountryName"])) {
                ##### xades:CountryName
                $xadesCountryName = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:CountryName");
                $xadesCountryName->nodeValue = $signatureProductionPlace["CountryName"];

                $xadesSignatureProductionPlace->appendChild($xadesCountryName);
            }

            $xadesSignedSignatureProperties->appendChild($xadesSignatureProductionPlace);
        }

        if (isset($context[self::SIGNER_ROLE])) {
            #### xades:SignerRole
            $xadesSignerRole = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SignerRole");

            ##### xades:ClaimedRoles
            $xadesClaimedRoles = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:ClaimedRoles");

            ###### xades:ClaimedRole
            $xadesClaimedRole = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:ClaimedRole");
            $xadesClaimedRole->nodeValue = $context[self::SIGNER_ROLE];

            $xadesClaimedRoles->appendChild($xadesClaimedRole);

            $xadesSignerRole->appendChild($xadesClaimedRoles);

            $xadesSignedSignatureProperties->appendChild($xadesSignerRole);
        }

        $xadesSignedProperties->appendChild($xadesSignedSignatureProperties);

        ### xades:SignedDataObjectProperties
        $xadesSignedDataObjectProperties = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:SignedDataObjectProperties");

        #### xades:DataObjectFormat
        $xadesDataObjectFormat = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:DataObjectFormat");
        $xadesDataObjectFormat->setAttribute("ObjectReference", "#Signature-$uid-Reference");

        ##### xades:ObjectIdentifier
        $xadesObjectIdentifier = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:ObjectIdentifier");

        ###### xades:Identifier
        $xadesIdentifier = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:Identifier");
        $xadesIdentifier->setAttribute("Qualifier", "OIDAsURN");
        $xadesIdentifier->nodeValue = self::DATA_OBJECT_FORMAT_IDENTIFIER;

        $xadesObjectIdentifier->appendChild($xadesIdentifier);

        $xadesDataObjectFormat->appendChild($xadesObjectIdentifier);

        ##### xades:MimeType
        $xadesMimeType = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XADES], "xades:MimeType");
        $xadesMimeType->nodeValue = self::DATA_OBJECT_FORMAT_MIME_TYPE;

        $xadesDataObjectFormat->appendChild($xadesMimeType);

        $xadesSignedDataObjectProperties->appendChild($xadesDataObjectFormat);

        #### xades:CommitmentTypeIndication
        // TODO

        #### xades:AllDataObjectsTimeStamp
        // TODO

        #### xades:IndividualDataObjectsTimeStamp
        // TODO

        $xadesSignedProperties->appendChild($xadesSignedDataObjectProperties);

        $xadesQualifyingProperties->appendChild($xadesSignedProperties);

        ## xades:UnsigedProperties
        // TODO

        ### xades:UnsigedSignatureProperties
        // TODO

        #### xades:CounterSignature
        // TODO

        $dsObject->appendChild($xadesQualifyingProperties);

        /* ---------- */
        /* ds:KeyInfo */
        /* ---------- */
        # ds:KeyValue
        $dsKeyValue = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:KeyValue");

        $publicKey = \openssl_pkey_get_details(\openssl_pkey_get_public($this->certificate));
        if ($publicKey["type"] == OPENSSL_KEYTYPE_DSA) {
            ## ds:DSAKeyValue
            $dsDSAKeyValue = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:DSAKeyValue");

            ### ds:P
            $dsP = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:P");
            $dsP->nodeValue = \base64_encode($publicKey["dsa"]["p"]);

            $dsDSAKeyValue->appendChild($dsP);

            ### ds:Q
            $dsQ = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:Q");
            $dsQ->nodeValue = \base64_encode($publicKey["dsa"]["q"]);

            $dsDSAKeyValue->appendChild($dsQ);

            ### ds:G
            $dsG = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:G");
            $dsG->nodeValue = \base64_encode($publicKey["dsa"]["g"]);

            $dsDSAKeyValue->appendChild($dsG);

            ### ds:Y
            $dsY = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:Y");
            $dsY->nodeValue = \base64_encode($publicKey["dsa"]["pub_key"]);

            $dsDSAKeyValue->appendChild($dsY);

            $dsKeyValue->appendChild($dsDSAKeyValue);
        } else if ($publicKey["type"] == OPENSSL_KEYTYPE_RSA) {
            ## ds:RSAKeyValue
            $dsRSAKeyValue = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:RSAKeyValue");

            ### ds:Modulus
            $dsModulus = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:Modulus");
            $dsModulus->nodeValue = \base64_encode($publicKey["rsa"]["n"]);

            $dsRSAKeyValue->appendChild($dsModulus);

            ### ds:Exponent
            $dsExponent = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:Exponent");
            $dsExponent->nodeValue = \base64_encode($publicKey["rsa"]["e"]);

            $dsRSAKeyValue->appendChild($dsExponent);

            $dsKeyValue->appendChild($dsRSAKeyValue);
        } else if ($publicKey["type"] == OPENSSL_KEYTYPE_EC) {
            ## dsig11:ECKeyValue
            $dsig11ECKeyValue = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG11], "dsig11:ECKeyValue");

            ### dsig11:NamedCurve
            $dsig11NamedCurve = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG11], "dsig11:NamedCurve");
            $dsig11NamedCurve->setAttribute("URI", "urn:oid:" . $publicKey["ec"]["curve_oid"]);

            $dsig11ECKeyValue->appendChild($dsig11NamedCurve);

            ### dsig11:PublicKey
            $dsig11PublicKey = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG11], "dsig11:PublicKey");
            $dsig11PublicKey->nodeValue = \base64_encode(0x04 . $publicKey["ec"]["x"] . $publicKey["ec"]["y"]);

            $dsig11ECKeyValue->appendChild($dsig11PublicKey);

            $dsKeyValue->appendChild($dsig11ECKeyValue);
        } else {
            throw new \Exception("Public key algorithm not supported.");
        }

        $dsKeyInfo->appendChild($dsKeyValue);

        # ds:X509Data
        $dsX509Data = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:X509Data");

        ## ds:X509Certificate (Signer certificate)
        $dsX509Certificate = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:X509Certificate");
        $dsX509Certificate->nodeValue = \str_replace(["-----BEGIN CERTIFICATE-----", "-----END CERTIFICATE-----", "\r", "\n"], "", $this->certificate);

        $dsX509Data->appendChild($dsX509Certificate);

        ## ds:X509Certificate (Extra certificates)
        foreach ($this->certificateChain as $certificate) {
            $dsX509Certificate = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:X509Certificate");
            $dsX509Certificate->nodeValue = \str_replace(["-----BEGIN CERTIFICATE-----", "-----END CERTIFICATE-----", "\r", "\n"], "", $certificate);

            $dsX509Data->appendChild($dsX509Certificate);
        }

        $dsKeyInfo->appendChild($dsX509Data);

        /* ------------- */
        /* ds:SignedInfo */
        /* ------------- */
        # ds:CanonicalizationMethod
        $dsCanonicalizationMethod = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:CanonicalizationMethod");
        $dsCanonicalizationMethod->setAttribute("Algorithm", self::CANONICALIZATION_ALGORITHMS_URIS[$context[self::CANONICALIZATION_METHOD]]);

        $dsSignedInfo->appendChild($dsCanonicalizationMethod);

        # ds:SignatureMethod
        $dsSignatureMethod = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:SignatureMethod");
        $dsSignatureMethod->setAttribute("Algorithm", self::SIGNATURE_ALGORITHMS_URIS[$context[self::SIGNATURE_METHOD]]);

        $dsSignedInfo->appendChild($dsSignatureMethod);

        # ds:Reference
        $dsReference = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:Reference");
        $dsReference->setAttribute("Id", "Signature-$uid-Reference");
        $dsReference->setAttribute("URI", "");

        ## ds:Transforms
        $dsTransforms = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:Transforms");

        ### ds:Transform
        $dsTransform = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:Transform");
        $dsTransform->setAttribute("Algorithm", self::CANONICALIZATION_ALGORITHMS_URIS[self::C14N_OC]);

        $dsTransforms->appendChild($dsTransform);

        ### ds:Transform
        $dsTransform = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:Transform");
        $dsTransform->setAttribute("Algorithm", self::TRANSFORM_ALGORITHMS_URIS[self::ENVELOPED_SIGNATURE]);

        $dsTransforms->appendChild($dsTransform);

        ### ds:Transform
        $dsTransform = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:Transform");
        $dsTransform->setAttribute("Algorithm", self::TRANSFORM_ALGORITHMS_URIS[self::XPATH]);

        #### ds:XPath
        $dsXPath = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:XPath");
        $dsXPath->setAttributeNS(self::XML_NS_URIS[self::XML_NS_XMLNS], "xmlns:ds", self::XML_NS_URIS[self::XML_NS_XMLDSIG]);
        $dsXPath->nodeValue = "not(ancestor-or-self::ds:Signature)";

        $dsTransform->appendChild($dsXPath);

        $dsTransforms->appendChild($dsTransform);

        $dsReference->appendChild($dsTransforms);

        ## ds:DigestMethod
        $dsDigestMethod = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:DigestMethod");
        $dsDigestMethod->setAttribute("Algorithm", self::DIGEST_ALGORITHMS_URIS[self::SHA512]);

        $dsReference->appendChild($dsDigestMethod);

        $xpath["namespaces"] = ["ds" => self::XML_NS_URIS[self::XML_NS_XMLDSIG]];
        $xpath["query"] = "(//. | //@* | //namespace::*)[not(ancestor-or-self::ds:Signature)]";

        ## ds:DigestValue
        $dsDigestValue = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:DigestValue");
        $dsDigestValue->nodeValue = \base64_encode(\hash(self::SHA512, $root->C14N(false, false, $xpath), true));

        $dsReference->appendChild($dsDigestValue);

        $dsSignedInfo->appendChild($dsReference);

        # ds:Reference
        $dsReference = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:Reference");
        $dsReference->setAttribute("Type", "http://uri.etsi.org/01903#SignedProperties");
        $dsReference->setAttribute("URI", "#Signature-$uid-SignedProperties");

        ## ds:DigestMethod
        $dsDigestMethod = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:DigestMethod");
        $dsDigestMethod->setAttribute("Algorithm", self::DIGEST_ALGORITHMS_URIS[self::SHA512]);

        $dsReference->appendChild($dsDigestMethod);

        ## ds:DigestValue
        $dsDigestValue = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:DigestValue");
        $dsDigestValue->nodeValue = \base64_encode(\hash(self::SHA512, $xadesSignedProperties->C14N(false, false), true));

        $dsReference->appendChild($dsDigestValue);

        $dsSignedInfo->appendChild($dsReference);

        # ds:Reference
        $dsReference = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:Reference");
        $dsReference->setAttribute("URI", "#Signature-$uid-KeyInfo");

        ## ds:DigestMethod
        $dsDigestMethod = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:DigestMethod");
        $dsDigestMethod->setAttribute("Algorithm", self::DIGEST_ALGORITHMS_URIS[self::SHA512]);

        $dsReference->appendChild($dsDigestMethod);

        ## ds:DigestValue
        $dsDigestValue = $doc->createElementNS(self::XML_NS_URIS[self::XML_NS_XMLDSIG], "ds:DigestValue");
        $dsDigestValue->nodeValue = \base64_encode(\hash(self::SHA512, $dsKeyInfo->C14N(false, false), true));

        $dsReference->appendChild($dsDigestValue);

        $dsSignedInfo->appendChild($dsReference);

        if ($context[self::CANONICALIZATION_METHOD] == self::C14N_OC) {
            $exclusive = false;
            $withComments = false;
        } else if ($context[self::CANONICALIZATION_METHOD] == self::C14N_WC) {
            $exclusive = false;
            $withComments = true;
        } else if ($context[self::CANONICALIZATION_METHOD] == self::C14N11_OC) {
            $exclusive = false;
            $withComments = false;
        } else if ($context[self::CANONICALIZATION_METHOD] == self::C14N11_WC) {
            $exclusive = false;
            $withComments = true;
        } else if ($context[self::CANONICALIZATION_METHOD] == self::C14N_EXC_OC) {
            $exclusive = true;
            $withComments = false;
        } else if ($context[self::CANONICALIZATION_METHOD] == self::C14N_EXC_WC) {
            $exclusive = true;
            $withComments = true;
        } else {
            throw new \Exception("Canonicalization algorithm not supported.");
        }

        if ($context[self::SIGNATURE_METHOD] == self::RSA_SHA1) {
            \openssl_sign($dsSignedInfo->C14N($exclusive, $withComments), $signature, \openssl_pkey_get_private($this->privateKey), OPENSSL_ALGO_SHA1);
        } else if ($context[self::SIGNATURE_METHOD] == self::RSA_SHA224) {
            \openssl_sign($dsSignedInfo->C14N($exclusive, $withComments), $signature, \openssl_pkey_get_private($this->privateKey), OPENSSL_ALGO_SHA224);
        } else if ($context[self::SIGNATURE_METHOD] == self::RSA_SHA256) {
            \openssl_sign($dsSignedInfo->C14N($exclusive, $withComments), $signature, \openssl_pkey_get_private($this->privateKey), OPENSSL_ALGO_SHA256);
        } else if ($context[self::SIGNATURE_METHOD] == self::RSA_SHA384) {
            \openssl_sign($dsSignedInfo->C14N($exclusive, $withComments), $signature, \openssl_pkey_get_private($this->privateKey), OPENSSL_ALGO_SHA384);
        } else if ($context[self::SIGNATURE_METHOD] == self::RSA_SHA512) {
            \openssl_sign($dsSignedInfo->C14N($exclusive, $withComments), $signature, \openssl_pkey_get_private($this->privateKey), OPENSSL_ALGO_SHA512);
        } else if ($context[self::SIGNATURE_METHOD] == self::ECDSA_SHA1) {
            \openssl_sign($dsSignedInfo->C14N($exclusive, $withComments), $signature, \openssl_pkey_get_private($this->privateKey), OPENSSL_ALGO_SHA1);
        } else if ($context[self::SIGNATURE_METHOD] == self::ECDSA_SHA224) {
            \openssl_sign($dsSignedInfo->C14N($exclusive, $withComments), $signature, \openssl_pkey_get_private($this->privateKey), OPENSSL_ALGO_SHA224);
        } else if ($context[self::SIGNATURE_METHOD] == self::ECDSA_SHA256) {
            \openssl_sign($dsSignedInfo->C14N($exclusive, $withComments), $signature, \openssl_pkey_get_private($this->privateKey), OPENSSL_ALGO_SHA256);
        } else if ($context[self::SIGNATURE_METHOD] == self::ECDSA_SHA384) {
            \openssl_sign($dsSignedInfo->C14N($exclusive, $withComments), $signature, \openssl_pkey_get_private($this->privateKey), OPENSSL_ALGO_SHA384);
        } else if ($context[self::SIGNATURE_METHOD] == self::ECDSA_SHA512) {
            \openssl_sign($dsSignedInfo->C14N($exclusive, $withComments), $signature, \openssl_pkey_get_private($this->privateKey), OPENSSL_ALGO_SHA512);
        } else if ($context[self::SIGNATURE_METHOD] == self::DSA_SHA1) {
            \openssl_sign($dsSignedInfo->C14N($exclusive, $withComments), $signature, \openssl_pkey_get_private($this->privateKey), OPENSSL_ALGO_SHA1);
        } else if ($context[self::SIGNATURE_METHOD] == self::DSA_SHA256) {
            \openssl_sign($dsSignedInfo->C14N($exclusive, $withComments), $signature, \openssl_pkey_get_private($this->privateKey), OPENSSL_ALGO_SHA256);
        } else {
            throw new \Exception("Signature method not supported.");
        }

        /* ----------------- */
        /* ds:SignatureValue */
        /* ----------------- */
        $dsSignatureValue->nodeValue = \base64_encode($signature);

        if (!$xml = $doc->saveXML()) {
            throw new \Exception("Unable to sign XML data.");
        }

        return $xml;
    }

    public function verify(string $data): bool
    {
        throw new \Exception("Method " . __METHOD__ . " not implemented.");
    }
}