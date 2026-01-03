<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'comment'                   => $this->comment,
            'listing_id'                => $this->listing_id,
            'user_id'                   => $this->user_id,
            'user'                      => new UserResource($this->whenLoaded('user')),
            'listing'                   => new ListingResource($this->whenLoaded('listing')),
            'parent'                     => new CommentResource($this->whenLoaded('parent')),
            'replies'                    => CommentResource::collection($this->whenLoaded('replies')),
            'replies_count'              => $this->whenCounted('replies') ?? 0,
            'created_at'                  => $this->created_at?->diffForHumans(),
        ];
    }
}

