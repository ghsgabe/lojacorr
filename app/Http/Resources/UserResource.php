<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'          =>  $this -> id,
            'cep'         =>  $this -> cep,
            'name'        =>  $this -> name,
            'email'       =>  $this -> email,
            'street'      =>  $this -> street 
        ];
    }
}
