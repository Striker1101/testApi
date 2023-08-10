<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
           'id' => $this -> id,
            'customerId' => $this -> customer_id,
            'account' => $this -> account,
            'status' => $this -> status,
            'billedDate' => $this -> billed_date,
            'payedDate' => $this -> payed_date,
        ];
    }
}
