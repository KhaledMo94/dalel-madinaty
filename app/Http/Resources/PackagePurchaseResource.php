<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackagePurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'package'           => new PackageResource($this->package),
            'paid_amount'       => $this->paid_amount,
            'payment_status'    => $this->payment_status,
            'payment_method'    => $this->payment_method,
            'start_date'        => Carbon::parse($this->start_date),
            'end_date'          => Carbon::parse($this->end_date),
            'remaining_days'    => $this->remaining_days,
        ];
    }
}
