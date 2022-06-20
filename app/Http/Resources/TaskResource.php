<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return Arr::whereNotNull([
            'id' => $this->id,
            'title' => $this->title,
            'is_complete' => $this->is_complete,
            'user' => UserResource::make($this->user)
        ]);
    }
}
