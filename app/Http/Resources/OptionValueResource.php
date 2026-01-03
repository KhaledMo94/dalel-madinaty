<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionValueResource extends JsonResource
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
            'option'                    => new OptionResource($this->whenLoaded('option')),
        ];
    }
}
