<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
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
            'title' => $this->title,            
            'created_at_humans' => $this->created_at->diffForHumans(),
            // 'user' => ['data' => new UserResource($this->user)],
            'user' => ['data' => new UserResource($this->whenLoaded('user'))],
            
        ];
    }
}
