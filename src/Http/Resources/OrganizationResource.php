<?php

namespace Anacreation\Organization\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        $result = [
            'id'        => $this->id,
            'label'     => $this->label,
            'parent_id' => $this->parent_id,
        ];

        return $result;
    }

}
