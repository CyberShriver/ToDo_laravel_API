<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id'=>(string)$this->id,
            'attributes'=>[
                'name'=>$this->name,
                'description'=>$this->description,
                'priority'=>$this->priority,
                'created_at'=>$this->created_at,
                'updated_at'=>$this->updated_at,
            ],
            'Relationship'=>[
               'id'=>(string)$this->user->id,
               'name'=>$this->user->name ,
               'email'=>$this->user->email 
            ]
        ];
    }
}
