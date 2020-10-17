<?php

namespace Anacreation\Organization\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Entity extends MorphPivot
{
    protected $table = 'entity_organization';

    // region Relation

    public function organization(): BelongsTo {
        return $this->belongsTo(Organization::class);
    }

    public function instance(): MorphTo {
        return $this->morphTo('entity');
    }

    // endregion
}
