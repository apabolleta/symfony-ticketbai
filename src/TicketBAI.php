<?php

namespace APM\TicketBAIBundle;

/**
 * Class to handle TicketBAI system operation.
 *
 * @package  apabolleta/ticketbai-bundle
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class TicketBAI
{
    const L0_IDVersionTBAI = [
        "1.2" => "Versión actual del esquema utilizado."
    ];

    const L1_CodigoPais = [];  // ISO 3166-1 alpha-2

    const L2_IDType = [
        "02" => "NIF-IVA.",
        "03" => "Pasaporte.",
        "04" => "Documento oficial de identificación expedido por el país o territorio de residencia.",
        "05" => "Certificado de residencia.",
        "06" => "Otro documento probatorio."
    ];

    const L3_VariosDestinatarios = [
        "S" => "Sí.",
        "N" => "No."
    ];

    const L4_EmitidaPorTercerosODestinatario = [
        "N" => "Factura emitida por el propio emisor o emisora.",
        "T" => "Factura emitida por tercero o tercera.",
        "D" => "Factura emitida por el destinatario o la destinataria de la operación."
    ];

    const L5_FacturaSimplificada = [
        "S" => "Sí.",
        "N" => "No."
    ];

    const L6_FacturaEmitidaSustitucionSimplificada = [
        "S" => "Sí.",
        "N" => "No."
    ];

    const L7_Codigo = [
        "R1" => "Factura rectificativa: error fundado en derecho y Art. 80 Uno, Dos y Seis de la Ley del IVA.",
        "R2" => "Factura rectificativa: artículo 80 Tres de la Ley del IVA.",
        "R3" => "Factura rectificativa: artículo 80 Cuatro de la Ley del IVA.",
        "R4" => "Factura rectificativa: Resto.",
        "R5" => "Factura rectificativa en facturas simplificadas."
    ];

    const L8_Tipo = [
        "S" => "Factura rectificativa por sustitución.",
        "I" => "Factura rectificativa por diferencias."
    ];

    const L9_ClaveRegimenIVAOperacionTranscendencia = [
        "01" => "Operación de régimen general y cualquier otro supuesto que no esté recogido en los siguientes valores.",
        "02" => "Exportación.",
        "03" => "Operaciones a las que se aplique el régimen especial de bienes usados, objetos de arte, antigüedades y objetos de colección.",
        "04" => "Régimen especial del oro de inversión.",
        "05" => "Régimen especial de las agencias de viajes.",
        "06" => "Régimen especial grupo de entidades en IVA (Nivel Avanzado).",
        "07" => "Régimen especial del criterio de caja.",
        "08" => "Operaciones sujetas al IPSI/IGIC (Impuesto sobre la Producción, los Servicios y la Importación/Impuesto General Indirecto Canario).",
        "09" => "Facturación de las prestaciones de servicios de agencias de viaje que actúan como mediadoras en nombre y por cuenta ajena (disposición adicional 3ª del Reglamento de Facturación).",
        "10" => "Cobros por cuenta de terceros de honorarios profesionales o de derechos derivados de la propiedad industrial, de autor u otros por cuenta de sus socios, socias, asociados, asociadas, colegiados o colegiadas efectuados por sociedades, asociaciones, colegios profesionales u otras entidades que realicen estas funciones de cobro.",
        "11" => "Operaciones de arrendamiento de local de negocio sujetas a retención.",
        "12" => "Operaciones de arrendamiento de local de negocio no sujetas a retención.",
        "13" => "Operaciones de arrendamiento de local de negocio sujetas y no sujetas a retención.",
        "14" => "Factura con IVA pendiente de devengo en certificaciones de obra cuyo destinatario sea una Administración Pública.",
        "15" => "Factura con IVA pendiente de devengo en operaciones de tracto sucesivo.",
        "17" => "Operación acogida a alguno de los regímenes previstos en el Capítulo XI del Título IX (OSS e IOSS).",
        "19" => "Operaciones de actividades incluidas en el Régimen Especial de Agricultura, Ganadería y Pesca (REAGYP).",
        "51" => "Operaciones en recargo de equivalencia.",
        "52" => "Operaciones en régimen simplificado.",
        "53" => "Operaciones realizadas por personas o entidades que no tengan la consideración de empresarios, empresarias o profesionales a efectos del IVA."
    ];

    const L10_CausaExencion = [
        "E1" => "Exenta por el artículo 20 de la Ley del IVA.",
        "E2" => "Exenta por el artículo 21 de la Ley del IVA.",
        "E3" => "Exenta por el artículo 22 de la Ley del IVA.",
        "E4" => "Exenta por el artículo 23 y 24 de la Ley del IVA.",
        "E5" => "Exenta por el artículo 25 de la Ley del IVA.",
        "E6" => "Exenta por otra causa."
    ];

    const L11_TipoNoExenta = [
        "S1" => "Sin inversión del sujeto pasivo.",
        "S2" => "Con inversión del sujeto pasivo."
    ];

    const L12_OperacionEnRecargoDeEquivalenciaORegimenSimplificado = [
        "S" => "Sí.",
        "N" => "No."
    ];

    const L13_Causa = [
        "OT" => "No sujeto por el artículo 7 de la Ley del IVA. Otros supuestos de no sujeción.",
        "RL" => "No sujeto por reglas de localización."
    ];
}