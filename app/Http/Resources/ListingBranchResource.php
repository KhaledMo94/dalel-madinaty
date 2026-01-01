<?php

namespace App\Http\Resources;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListingBranchResource extends JsonResource
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
            'id'                            => $this->id,
            'address'                       => $this->getTranslation('address', $locale),
            'area'                          => new AreaResource($this->whenLoaded('area')),
            'phone'                         => $this->phone,
            'phone_alt'                     => $this->phone_alt,
            'location_url'                  => $this->location_url,
            'latitude'                      => number_format($this->latitude,10),
            'longitude'                     => number_format($this->longitude,10),
            'distance'                      => !is_null($this->distance) ? round($this->distance, 2) . " km" : null,
        ];
    }
}
