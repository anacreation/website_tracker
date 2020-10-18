<?php

namespace Anacreation\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

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

    public function inOrganization(object $entity): bool {
        return $this->entities()
                    ->where('entity_type',
                            get_class($entity))
                    ->where('entity_id',
                            $entity->id)
                    ->exists();
    }

    public function entities(): HasMany {
        return $this->hasMany(Entity::class);
    }

    public static function getTree(int $organization_id = null): Collection {
        $instance = new self;

        $query = $organization_id === null ?
            $instance->where('parent_id',
                             null):
            $instance->where('id',
                             $organization_id);

        return $query->with('children')
                     ->get()
                     ->each(fn($o) => $instance->loadChildren($o));
    }

    private function loadChildren(Organization $organization) {
        $organization->load('children');
        $organization->children
            ->each(fn($o) => $this->loadChildren($o));
    }

    // endregion
}
