<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AreaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = app()->getLocale();

        return [
            'id'                        => $this->id,
            'name'                      => $this->getTranslation('name', $locale),
            'description'               => $this->getTranslation('description', $locale),
            'city_id'                   => $this->city_id,
            'city'                      => new CityResource($this->whenLoaded('city')),
            'listing_branches'          => ListingBranchResource::collection($this->whenLoaded('listingBranches')),
            'listing_branches_count'    => $this->whenCounted('listingBranches') ?? 0,
            'users_count'               => $this->whenCounted('users') ?? 0,
        ];
    }
}

