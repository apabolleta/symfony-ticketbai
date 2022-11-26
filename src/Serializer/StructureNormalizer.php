<?php

namespace APM\TicketBAIBundle\Serializer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use APM\TicketBAIBundle\StructureInterface;

/**
 * Class to implement TicketBAIBundle data structure normalizer.
 *
 * @package  apabolleta/symfony-ticketbai
 * @author   Asier Pabolleta Martorell <apabolleta@gmail.com>
 *
 */
class StructureNormalizer implements NormalizerInterface
{
    /**
     * Flag to skip uninitialized typed class properties.
     */
    const SKIP_UNINITIALIZED_VALUES = 'skip_uninitialized_values';

    /**
     * Flag to skip null value properties.
     */
    const SKIP_NULL_VALUES = 'skip_null_values';

    /**
     * Flag to set default value for uninitialized typed properties.
     *
     * If SKIP_UNINITIALIZED_VALUES flag set to false, this value is given to uninitialized typed class properties.
     * Otherwise, this flag is skipped.
     */
    const UNINITIALIZED_PROPERTY_VALUE = 'uninitialized_property_value';

    /**
     * Default normalizer context.
     */
    private $defaultContext = [
        self::SKIP_UNINITIALIZED_VALUES => true,
        self::SKIP_NULL_VALUES => true,
        self::UNINITIALIZED_PROPERTY_VALUE => null
    ];

    public function normalize($structure, string $format = null, array $context = [])
    {
        $normalized = [];  # Normalized data

        $context = \array_merge($this->defaultContext, $context);  # Get context

        $reflection = new \ReflectionClass($structure);
        foreach ($reflection->getProperties() as $property) {

            $property->setAccessible(true);  # Change property accessibility

            $name = $property->getName();

            if (true == $property->isInitialized($structure)) {
                $value = $property->getValue($structure);
            } else {
                if (true == $context[self::SKIP_UNINITIALIZED_VALUES]) continue;
                else $value = $context[self::UNINITIALIZED_PROPERTY_VALUE];
            }

            switch (\gettype($value)) {
                case "array":
                    foreach ($value as $v) {
                        $normalized[$name][(new \ReflectionClass($v))->getShortName()][] = $this->normalize($v, null, []);
                    }
                    break;

                case "object":
                    $normalized[$name] = $this->normalize($value, null, []);
                    break;

                case "string":
                    $normalized[$name] = $value;
                    break;

                case "NULL":
                    if (true == $context[self::SKIP_NULL_VALUES]) continue;

                default:
                    $normalized[$name] = (string) $value;
            }

        }

        return $normalized;
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof StructureInterface;
    }
}