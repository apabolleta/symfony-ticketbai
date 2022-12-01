<?php

namespace APM\TicketBAIBundle\TicketBAI;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;

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

    const ENV_ARABA    = "Araba";
    const ENV_BIZKAIA  = "Bizkaia";
    const ENV_GIPUZKOA = "Gipuzkoa";

    const ENV_VALUES = [
        self::ENV_ARABA,
        self::ENV_BIZKAIA,
        self::ENV_GIPUZKOA
    ];

    const XML_VERSION  = "1.0";
    const XML_ENCODING = "UTF-8";

    const XML_NS_T               = "T";
    const XML_NS_T_URI_ALTA      = "urn:ticketbai:emision";
    const XML_NS_T_URI_ANULACION = "urn:ticketbai:anulacion";

    const XML_NS_DS     = "ds";
    const XML_NS_DS_URI = "http://www.w3.org/2000/09/xmldsig#";

    const XML_NS_XSI              = "xsi";
    const XML_NS_XSI_URI          = "http://www.w3.org/2001/XMLSchema-instance";
    const XML_NS_XSI_SL_ALTA      = "urn:ticketbai:emision ticketBaiV1-2-1.xsd";
    const XML_NS_XSI_SL_ANULACION = "urn:ticketbai:anulacion Anula_ticketBaiV1-2-1.xsd";

    const XML_ROOT_NODE_NAME_ALTA      = self::XML_NS_T . ":TicketBai";
    const XML_ROOT_NODE_NAME_ANULACION = self::XML_NS_T . ":AnulaTicketBai";

    private $validator;
    private $serializer;
    private $signer;

    private $validator_context;
    private $serializer_context;
    private $signer_context;

    public function __construct(string $env = null, bool $strict = false)
    {
        $this->validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        $this->validator_context = ['Default'];

        if ($env && !\in_array($env, self::ENV_VALUES)) {
            throw new \InvalidArgumentException('The $env argument contains an invalid value.');
        }

        if (null != $env) {
            \array_push($this->validator_context, $env);
        }

        if (true == $strict) {
            \array_push($this->validator_context, 'Strict');
        }

        $encoders = [new XmlEncoder()];
        $normalizers = [new StructureNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);

        $this->serializer_context = [
            XmlEncoder::FORMAT_OUTPUT => true,
            XmlEncoder::VERSION => self::XML_VERSION,
            XmlEncoder::ENCODING => self::XML_ENCODING
        ];

        $this->signer = new XMLSigner();

        $this->signer_context = [
            XMLSigner::XML_NS_DS => self::XML_NS_DS,
            XMLSigner::XML_NS_DS_URI => self::XML_NS_DS_URI
        ];
    }

    public function alta(FicheroAlta $ficheroAlta): Response
    {
        $violations = $this->validator->validate($ficheroAlta, null, $this->validator_context);

        if (count($violations) > 0) {
            throw new ValidationFailedException;
        }

        $serializer_context = \array_merge($this->serializer_context, [XmlEncoder::ROOT_NODE_NAME => self::XML_ROOT_NODE_NAME_ALTA]);

        $arr = $this->serializer->normalize($ficheroAlta, null, $serializer_context);

        $xml = $this->serializer->encode([
            '@xmlns:' . self::XML_NS_T => self::XML_NS_T_URI_ALTA,
            '@xmlns:' . self::XML_NS_DS => self::XML_NS_DS_URI,
            '@xmlns:' . self::XML_NS_XSI => self::XML_NS_XSI_URI,
            '@' . self::XML_NS_XSI . ":schemaLocation" => self::XML_NS_XSI_SL_ALTA,
            '#' => $arr
        ], 'xml', $serializer_context);

        $xml_signed = $this->signer->sign($xml, null, $this->signer_context);

        # TODO: Send

        # TODO: Return Response
    }

    public function anulacion(FicheroAnulacion $ficheroAnulacion): Response
    {
        $violations = $this->validator->validate($ficheroAnulacion, null, $this->validator_context);

        if (count($violations) > 0) {
            throw new ValidationFailedException;
        }

        $serializer_context = \array_merge($this->serializer_context, [XmlEncoder::ROOT_NODE_NAME => self::XML_ROOT_NODE_NAME_ANULACION]);

        $arr = $this->serializer->normalize($ficheroAnulacion, null, $serializer_context);

        $xml = $this->serializer->encode([
            '@xmlns:' . self::XML_NS_T => self::XML_NS_T_URI_ANULACION,
            '@xmlns:' . self::XML_NS_DS => self::XML_NS_DS_URI,
            '@xmlns:' . self::XML_NS_XSI => self::XML_NS_XSI_URI,
            '@' . self::XML_NS_XSI . ":schemaLocation" => self::XML_NS_XSI_SL_ANULACION,
            '#' => $arr
        ], 'xml', $serializer_context);

        $xml_signed = $this->signer->sign($xml, null, $this->signer_context);

        # TODO: Send

        # TODO: Return Response
    }
}