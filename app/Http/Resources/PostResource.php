<?php

namespace App\Http\Resources;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this["id"],
            'title'=> $this["name"],
            'content' => $this["latitude"],
            'image'=> $this["longitude"],
            'category'=>$this["category"]["name"],
            'created_at'=> Carbon::parse($this["created_at"])->format('d.m.Y H:i'),
            'updated_at'=> Carbon::parse($this["updated_at"])->format('d.m.Y H:i'),
        ];
    }
}
