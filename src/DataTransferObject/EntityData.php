<?php
/**
 * A & A Creation Co.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    A & A Creation
 * @package     ${PACKAGE}
 * @Date        : 18/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Anacreation\Organization\DataTransferObject;


class EntityData
{

    private int $entity_id;
    private string $entity_type;

    public static function construct(int $entity_id, string $entity_type): self {
        $instance = new self;
        $instance->entity_id = $entity_id;
        $instance->entity_type = $entity_type;

        return $instance;
    }

    /**
     * EntityData constructor.
     * @param int    $entity_id
     * @param string $entity_type
     */
    public static function fromFormData(int $entity_id, string $entity_type): self {
        return self::construct($entity_id,
                               $entity_type);
    }


    public function getEntityType(): string {
        return $this->entity_type;
    }

    public function getEntityId(): int {
        return $this->entity_id;
    }
}
