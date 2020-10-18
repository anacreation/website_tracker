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
 * @Date        : 17/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Anacreation\Organization\Traits;


use Anacreation\Organization\Entities\Entity;
use Anacreation\Organization\Entities\Organization;
use Exception;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait InOrganization
{
    protected function organizations(): MorphToMany {
        return $this->morphToMany(Organization::class,
                                  'entity',
                                  'entity_organization')
                    ->withPivot('include_sub_org')
                    ->as('entity')
                    ->using(Entity::class)
                    ->withTimestamps();
    }

    public function isInOrganization(Organization $organization): bool {
        return $organization->inOrganization($this);
    }

    public function assignToOrganization(
        Organization $organization, bool $include_sub_org = false): void {
        try {
            $this->organizations()->attach($organization,['include_sub_org'=>$include_sub_org]);
        } catch (Exception $e) {
        }
    }
}
