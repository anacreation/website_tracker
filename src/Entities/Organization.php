<?php

namespace Anacreation\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Organization extends Model
{
    protected $fillable = [
        'label',
        'parent_id',
    ];

    // region Relation

    public function parent(): BelongsTo {
        return $this->belongsTo(Organization::class,
                                'parent_id');
    }

    public function children(): HasMany {
        return $this->hasMany(Organization::class,
                              'parent_id');
    }

    // endregion

    // region Helpers

    public function hasEntity(object $entity): bool {
        return $this->entities()
                    ->where('entity_type',
                            get_class($entity))
                    ->where('entity_id',
                            $entity->id)
                    ->exists();
    }

    public static function isInSameOrganization(object $entity_1, object $entity_2): bool {
        $entity1ClassName = get_class($entity_1);
        $entity2ClassName = get_class($entity_2);

        $query = DB::raw("SELECT organization_id
FROM entity_organization
WHERE entity_type = '{$entity1ClassName}' AND entity_id = {$entity_1->id}

INTERSECT

SELECT organization_id
FROM entity_organization
WHERE entity_type = '{$entity2ClassName}' AND entity_id = {$entity_2->id} ");

        return count(DB::select($query)) > 0;
    }

    public function entities(): HasMany {
        return $this->hasMany(Entity::class);
    }

    public static function getTree(int $organization_id = null): Collection {

        return Organization::whereIn('id',
                                     collect(DB::select(Organization::getRecursiveSql($organization_id)))
                                         ->pluck('id'))
                           ->get();
    }

    public static function getRecursiveSql(int $parent_id = null) {

        if($parent_id !== null) {
            return DB::raw("WITH RECURSIVE organization_paths AS (
	SELECT
		id,
		parent_id
	FROM organizations
	WHERE parent_id = {$parent_id} OR id = {$parent_id}
	UNION ALL
	SELECT
		o.id,
		o.parent_id
	FROM
		organizations AS o
		INNER JOIN organization_paths op ON op.id = o.parent_id
)
SELECT
	id
FROM
	organization_paths op");
        }

        return DB::raw("WITH RECURSIVE organization_paths AS (
	SELECT
		id,
		parent_id
	FROM organizations
	WHERE parent_id IS NULL
	UNION ALL
	SELECT
		o.id,
		o.parent_id
	FROM
		organizations AS o
		INNER JOIN organization_paths op ON op.id = o.parent_id
)
SELECT
	id
FROM
	organization_paths op");

    }

    // endregion
}
