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
 * @package     anacreation/organization
 * @Date        : 18/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Anacreation\Organization\Actions;


use Anacreation\Organization\DataTransferObject\EntityData;
use Anacreation\Organization\Entities\Entity;
use Anacreation\Organization\Entities\Organization;

class DetachEntityFromOrganization
{

    public function execute(Organization $organization, EntityData $dto): void {

        /** @var Entity|null $entity */
        $entity = $organization->entities()->where('entity_type',
                                                   $dto->getEntityType())
                               ->where('entity_id',
                                       $dto->getEntityId())
                               ->first();

        if($entity !== null) {
            $entity->delete();
        }
    }
}
