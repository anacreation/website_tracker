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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\DB;

trait InOrganization
{
    public function organizations(): MorphToMany {
        return $this->morphToMany(Organization::class,
                                  'entity',
                                  'entity_organization')
                    ->withPivot('include_sub_org')
                    ->as('entity')
                    ->using(Entity::class)
                    ->withTimestamps();
    }

    public function isInOrganization(Organization $organization): bool {
        return $organization->hasEntity($this);
    }

    public function assignToOrganization(
        Organization $organization, bool $include_sub_org = false): void {
        try {
            $this->organizations()->attach($organization,
                                           ['include_sub_org' => $include_sub_org]);
        } catch (Exception $e) {
        }
    }

    public function scopeInOrganization(
        Builder $q, Organization $organization, bool $include_sub_org = false): Builder {

        if($include_sub_org) {
            return $q->whereHas('organizations',
                function($sq) use ($organization) {
                    return $sq->whereIn('organization_id',
                                        collect(DB::select(Organization::getRecursiveSql($organization->id)))
                                            ->pluck('id')->values()
                                            ->toArray());
                });
        }

        return $q->whereHas('organizations',
            function($sq) use ($organization) {
                return $sq->where('organization_id',
                                  $organization->id);
            });

    }
}
