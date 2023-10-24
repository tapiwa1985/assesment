<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'booking_id' => (int)$this->booking_id,
            'reason' => $this->reason,
            'date_booked' => (string)$this->date_booked,
            'user' => new UserResource($this->user)
        ];
    }
}
