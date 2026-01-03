<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                        => $this->id,
            'rating'                    => $this->rating,
            'comment'                   => $this->comment,
            'user_id'                   => $this->user_id,
            'listing_id'                => $this->listing_id,
            'user'                      => new UserResource($this->whenLoaded('user')),
            'listing'                   => new ListingResource($this->whenLoaded('listing')),
            'created_at'                  => $this->created_at?->diffForHumans(),
        ];
    }
}

