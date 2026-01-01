<?php

namespace App\Http\Resources;

use App\Models\ListingBranch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
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
            'description'               => strip_tags($this->getTranslation('description', $locale)),
            'category'                  => new CategoryResource($this->whenLoaded('category')),
            'image'                     => $this->image ? asset('storage/' . $this->image) : null,
            'banner_image'               => $this->banner_image ? asset('storage/' . $this->banner_image) : null,
            'file'                      => $this->file ? asset('storage/' . $this->file) : null,
            'amenities'                 => AmenityResource::collection($this->whenLoaded('amenities')),
            'users'                     => UserResource::collection($this->whenLoaded('users')),
            'branches'                  => ListingBranchResource::collection($this->whenLoaded('branches')),
            'nearest_branch'            => new ListingBranchResource($this->whenLoaded('nearestListingBranch')),
            'tt_link'                   => $this->tt_link,
            'fb_link'                   => $this->fb_link,
            'insta_link'                   => $this->insta_link,
            'offers'                      => OfferResource::collection($this->whenLoaded('offers')),
            'avg_rating'                  => $this->whenAggregated('ratings', 'rating', 'avg'),
            'ratings_count'               => $this->whenCounted('ratings') ?? 0,
            'images'                      => ListingImageResource::collection($this->whenLoaded('images')),
            'is_liked'                    => $this->is_liked ?? false,
        ];
    }
}
