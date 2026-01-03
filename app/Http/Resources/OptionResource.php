<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
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
            'option_values'             => OptionValueResource::collection($this->whenLoaded('optionValues')),
            'option_values_count'       => $this->whenCounted('optionValues') ?? 0,
        ];
    }
}
