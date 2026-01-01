<?php

namespace App\Http\Resources;

use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'                      => $this->name,
            'phone'                     => $this->phone,
            'image'                     => $this->image ? asset('storage/' . $this->image) : null,
            'area_id'                   => $this->area_id,
            'area'                      => new AreaResource($this->whenLoaded('area')),
            'phone_verified'         => $this->phone_verified_at ? true : false,
            'listings_count'         => $this->whenCounted('listings') ?? 0,
            'ratings_count'         => $this->whenCounted('ratings') ?? 0,
            // 'comments_count'         => $this->whenCounted('comments') ?? 0,
            'commenter_listing'         => new ListingResource($this->whenLoaded('commenterListing')),

        ];
    }
}
