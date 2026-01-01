<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'id'                       => $this->id,
            'name'                     => $this->getTranslation('name', $locale) ?? '',
            'price'                    => $this->price,
            'valid_days'               => $this->valid_days,
        ];
    }
}
