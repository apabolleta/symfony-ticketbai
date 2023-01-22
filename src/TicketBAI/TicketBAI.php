<?php

namespace APM\TicketBAIBundle\TicketBAI;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpClient\HttpClient;

use APM\TicketBAIBundle\Exception\ValidationFailedException;
use APM\TicketBAIBundle\Serializer\StructureNormalizer;
use APM\TicketBAIBundle\Signer\XMLSigner;
use APM\TicketBAIBundle\TicketBAI\Alta\FicheroAlta;
use APM\TicketBAIBundle\TicketBAI\Anulacion\FicheroAnulacion;
use APM\TicketBAIBundle\TicketBAI\Response;

/**
 * Class to handle TicketBAI system operation.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class TicketBAI
{
    const L0_IDVersionTBAI = [
        "1.2",  # Versión actual del esquema utilizado.
    ];

    const L1_CodigoPais = [];  // ISO 3166-1 alpha-2

    const L2_IDType = [
        "02",  # NIF-IVA.
        "03",  # Pasaporte.
        "04",  # Documento oficial de identificación expedido por el país o territorio de residencia.
        "05",  # Certificado de residencia.
        "06",  # Otro documento probatorio.
    ];

    const L3_VariosDestinatarios = [
        "S",  # Sí.
        "N",  # No.
    ];

    const L4_EmitidaPorTercerosODestinatario = [
        "N",  # Factura emitida por el propio emisor o emisora.
        "T",  # Factura emitida por tercero o tercera.
        "D",  # Factura emitida por el destinatario o la destinataria de la operación.
    ];

    const L5_FacturaSimplificada = [
        "S",  # Sí.
        "N",  # No.
    ];

    const L6_FacturaEmitidaSustitucionSimplificada = [
        "S",  # Sí.
        "N",  # No.
    ];

    const L7_Codigo = [
        "R1",  # Factura rectificativa: error fundado en derecho y Art. 80 Uno, Dos y Seis de la Ley del IVA.
        "R2",  # Factura rectificativa: artículo 80 Tres de la Ley del IVA.
        "R3",  # Factura rectificativa: artículo 80 Cuatro de la Ley del IVA.
        "R4",  # Factura rectificativa: Resto.
        "R5",  # Factura rectificativa en facturas simplificadas.
    ];

    const L8_Tipo = [
        "S",  # Factura rectificativa por sustitución.
        "I",  # Factura rectificativa por diferencias.
    ];

    const L9_ClaveRegimenIVAOperacionTranscendencia = [
        "01",  # Operación de régimen general y cualquier otro supuesto que no esté recogido en los siguientes valores.
        "02",  # Exportación.
        "03",  # Operaciones a las que se aplique el régimen especial de bienes usados, objetos de arte, antigüedades y objetos de colección.
        "04",  # Régimen especial del oro de inversión.
        "05",  # Régimen especial de las agencias de viajes.
        "06",  # Régimen especial grupo de entidades en IVA (Nivel Avanzado).
        "07",  # Régimen especial del criterio de caja.
        "08",  # Operaciones sujetas al IPSI/IGIC (Impuesto sobre la Producción, los Servicios y la Importación/Impuesto General Indirecto Canario).
        "09",  # Facturación de las prestaciones de servicios de agencias de viaje que actúan como mediadoras en nombre y por cuenta ajena (disposición adicional 3ª del Reglamento de Facturación).
        "10",  # Cobros por cuenta de terceros de honorarios profesionales o de derechos derivados de la propiedad industrial, de autor u otros por cuenta de sus socios, socias, asociados, asociadas, colegiados o colegiadas efectuados por sociedades, asociaciones, colegios profesionales u otras entidades que realicen estas funciones de cobro.
        "11",  # Operaciones de arrendamiento de local de negocio sujetas a retención.
        "12",  # Operaciones de arrendamiento de local de negocio no sujetas a retención.
        "13",  # Operaciones de arrendamiento de local de negocio sujetas y no sujetas a retención.
        "14",  # Factura con IVA pendiente de devengo en certificaciones de obra cuyo destinatario sea una Administración Pública.
        "15",  # Factura con IVA pendiente de devengo en operaciones de tracto sucesivo.
        "17",  # Operación acogida a alguno de los regímenes previstos en el Capítulo XI del Título IX (OSS e IOSS).
        "19",  # Operaciones de actividades incluidas en el Régimen Especial de Agricultura, Ganadería y Pesca (REAGYP).
        "51",  # Operaciones en recargo de equivalencia.
        "52",  # Operaciones en régimen simplificado.
        "53",  # Operaciones realizadas por personas o entidades que no tengan la consideración de empresarios, empresarias o profesionales a efectos del IVA.
    ];

    const L10_CausaExencion = [
        "E1",  # Exenta por el artículo 20 de la Ley del IVA.
        "E2",  # Exenta por el artículo 21 de la Ley del IVA.
        "E3",  # Exenta por el artículo 22 de la Ley del IVA.
        "E4",  # Exenta por el artículo 23 y 24 de la Ley del IVA.
        "E5",  # Exenta por el artículo 25 de la Ley del IVA.
        "E6",  # Exenta por otra causa.
    ];

    const L11_TipoNoExenta = [
        "S1",  # Sin inversión del sujeto pasivo.
        "S2",  # Con inversión del sujeto pasivo.
    ];

    const L12_OperacionEnRecargoDeEquivalenciaORegimenSimplificado = [
        "S",  # Sí.
        "N",  # No.
    ];

    const L13_Causa = [
        "OT",  # No sujeto por el artículo 7 de la Ley del IVA. Otros supuestos de no sujeción.
        "RL",  # No sujeto por reglas de localización.
    ];

    const Alta_CodigosResultado = [
        "00",  # Recibido. El fichero de alta TicketBAI se ha recibido.
        "01",  # Rechazado. El fichero de alta TicketBAI contiene errores que impiden su recepción.
    ];

    const Anulacion_CodigosResultado = [
        "00",  # Recibido. El fichero de anulación TicketBAI se ha recibido.
        "01",  # Rechazado. El fichero de anulación TicketBAI contiene errores que impiden su recepción.
    ];

    const ENV_PROD = "Prod";
    const ENV_TEST = "Test";

    const ENV_ARABA    = "Araba";
    const ENV_BIZKAIA  = "Bizkaia";
    const ENV_GIPUZKOA = "Gipuzkoa";

    const ENV_LIST = [
        # self::ENV_ARABA,
        # self::ENV_BIZKAIA,
        self::ENV_GIPUZKOA
    ];

    const TICKETBAI_ALTA_URL = [
        self::ENV_PROD => [
            self::ENV_ARABA    => "https://ticketbai.araba.eus/TicketBAI/v1/facturas/",
            self::ENV_BIZKAIA  => null,
            self::ENV_GIPUZKOA => "https://tbai-z.egoitza.gipuzkoa.eus/sarrerak/alta"
        ],
        self::ENV_TEST => [
            self::ENV_ARABA    => "https://pruebas-ticketbai.araba.eus/TicketBAI/v1/facturas/",
            self::ENV_BIZKAIA  => null,
            self::ENV_GIPUZKOA => "https://tbai-z.prep.gipuzkoa.eus/sarrerak/alta"
        ]
    ];

    const TICKETBAI_ANULACION_URL = [
        self::ENV_PROD => [
            self::ENV_ARABA    => "https://ticketbai.araba.eus/TicketBAI/v1/anulaciones/",
            self::ENV_BIZKAIA  => null,
            self::ENV_GIPUZKOA => "https://tbai-z.egoitza.gipuzkoa.eus/sarrerak/baja"
        ],
        self::ENV_TEST => [
            self::ENV_ARABA    => "https://pruebas-ticketbai.araba.eus/TicketBAI/v1/anulaciones/",
            self::ENV_BIZKAIA  => null,
            self::ENV_GIPUZKOA => "https://tbai-z.prep.gipuzkoa.eus/sarrerak/baja"
        ]
    ];

    const SIGNATURE_POLICY_IDENTIFIER = [
        self::ENV_ARABA    => "https://ticketbai.araba.eus/tbai/sinadura/",
        self::ENV_BIZKAIA  => "https://www.batuz.eus/fitxategiak/batuz/ticketbai/especificaciones_firma_v1_0.pdf",
        self::ENV_GIPUZKOA => "https://www.gipuzkoa.eus/ticketbai/sinadura"
    ];

    const SIGNATURE_POLICY_URI = [
        self::ENV_ARABA    => "https://ticketbai.araba.eus/tbai/sinadura/",
        self::ENV_BIZKAIA  => "https://www.batuz.eus/fitxategiak/batuz/ticketbai/especificaciones_firma_v1_0.pdf",
        self::ENV_GIPUZKOA => "https://www.gipuzkoa.eus/ticketbai/sinadura"
    ];

    const SIGNATURE_POLICY_DIGEST_METHOD = [
        self::ENV_ARABA    => XMLSigner::SHA256,
        self::ENV_BIZKAIA  => XMLSigner::SHA256,
        self::ENV_GIPUZKOA => XMLSigner::SHA256
    ];

    const SIGNATURE_POLICY_DIGEST_VALUE = [
        self::ENV_ARABA    => "4Vk3uExj7tGn9DyUCPDsV9HRmK6KZfYdRiW3StOjcQA=",
        self::ENV_BIZKAIA  => "Quzn98x3PMbSHwbUzaj5f5KOpiH0u8bvmwbbbNkO9Es=",
        self::ENV_GIPUZKOA => "vSe1CH7eAFVkGN0X2Y7Nl9XGUoBnziDA5BGUSsyt8mg="
    ];

    /**
     * Flag to set environment.
     */
    const ENV = 'env';

    /**
     * Default context.
     */
    private $defaultContext = [
        self::ENV => self::ENV_PROD
    ];

    private $validatorContext;
    private $serializerContext;
    private $signerContext;
    private $httpClientContext;

    private $validator;
    private $serializer;
    private $signer;
    private $httpClient;

    public function __construct(string $env, string $pkcs12, string $passphrase, bool $strict = false)
    {
        // Validator
        if (!\in_array($env, self::ENV_LIST)) {
            throw new \Exception('Invalid environment value provided.');
        }

        $this->validatorContext = [
            'Default',
            $env
        ];

        if (true == $strict) {
            \array_push($this->validatorContext, 'Strict');
        }

        $this->validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        // Serializer
        $this->serializerContext = [
            XmlEncoder::FORMAT_OUTPUT => true,
            XmlEncoder::VERSION => "1.0",
            XmlEncoder::ENCODING => "UTF-8"
        ];

        $encoders = [new XmlEncoder()];
        $normalizers = [new StructureNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);

        // Signer
        $this->signerContext = [
            XMLSigner::SIGNATURE_POLICY_IDENTIFIER => self::SIGNATURE_POLICY_IDENTIFIER[$env],
            XMLSigner::SIGNATURE_POLICY_URI => self::SIGNATURE_POLICY_URI[$env],
            XMLSigner::SIGNATURE_POLICY_DIGEST_METHOD => self::SIGNATURE_POLICY_DIGEST_METHOD[$env],
            XMLSigner::SIGNATURE_POLICY_DIGEST_VALUE => self::SIGNATURE_POLICY_DIGEST_VALUE[$env]
        ];

        if (!\openssl_pkcs12_read($pkcs12, $certificates, $passphrase)) {
            throw new \Exception('Invalid certificate store.');
        }

        $this->signer = new XMLSigner($certificates["pkey"], $certificates["cert"], $certificates["extracerts"] ?? []);

        // HTTP Client
        $this->httpClientContext = [
            'method' => 'POST',
            'env' => $env
        ];

        $this->httpClient = HttpClient::create();
    }

    public function alta(FicheroAlta $ficheroAlta, string $format = null, array $context = []): Response
    {
        $context = \array_merge($this->defaultContext, $context);

        $violations = $this->validator->validate($ficheroAlta, null, $this->validatorContext);

        if (count($violations) > 0) {
            throw new ValidationFailedException;
        }

        $serializerContext = \array_merge($this->serializerContext, [XmlEncoder::ROOT_NODE_NAME => "T:TicketBai"]);

        $arr = $this->serializer->normalize($ficheroAlta, null, $serializerContext);

        $xml = $this->serializer->encode([
            '@xmlns:T' => "urn:ticketbai:emision",
            '@xmlns:ds' => "http://www.w3.org/2000/09/xmldsig#",
            '@xmlns:xsi' => "http://www.w3.org/2001/XMLSchema-instance",
            '@xsi:schemaLocation' => "urn:ticketbai:emision ticketBaiV1-2-1.xsd",
            '#' => $arr
        ], 'xml', $serializerContext);

        $xml_signed = $this->signer->sign($xml, null, $this->signerContext);

        $response = $this->httpClient->request(
            $this->httpClientContext['method'],
            self::TICKETBAI_ALTA_URL[$context[self::ENV]][$this->httpClientContext['env']],
            [
                'headers' => [
                    'Content-Type' => 'application/xml;charset=UTF-8'
                ],
                'body' => $xml_signed
            ]);

        return new Response();
    }

    public function anulacion(FicheroAnulacion $ficheroAnulacion): Response
    {
        throw new \BadMethodCallException("Method " . __METHOD__ . " not implemented.");
    }
}