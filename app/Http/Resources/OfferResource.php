<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'content'                       => $this->getTranslation('content', $locale),
            'image'                          => $this->image ? asset('storage/' . $this->image) : null,
            'listing_id'                    => $this->listing_id,
            'listing'                       => new ListingResource($this->whenLoaded('listing')),
            'start_date'                    => $this->start_date ? $this->start_date->format('Y-m-d H:i:s') : null,
            'end_date'                      => $this->end_date ? $this->end_date->format('Y-m-d H:i:s') : null,
            'is_active'                     => $this->is_active,
        ];
    }
}
