<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EsccortItem extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */


    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'salary' => $this->salary,
            'keahlian' => $this->keahlian,
            'name' => $this->name,
            'age' => $this->age,
            'address' => $this->address,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'rating' => $this->rating,
            'photo' => $this->photo,
        ];
    }
}
