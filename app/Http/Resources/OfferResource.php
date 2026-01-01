<?php

namespace App\Http\Resources;

use App\Http\Controllers\ListingBranchController;
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
            'id'                            =>$this->id,
            'content'                       =>$this->getTranslation('content',$locale),
            'image'                         =>asset('storage/'.$this->image),
            'branch'                        =>new ListingBranchResource($this->whenLoaded('listingBranch')),
        ];
    }
}
