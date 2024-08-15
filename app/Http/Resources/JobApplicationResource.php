<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "Başvuran kişi"=>new UserResource($this->whenLoaded('user')),
            "Ön yazı"=>$this->resource->cover_letter,
            "Başvuru Tarihi "=> Carbon::parse($this->resource->created_at)->format('l, F j, Y'),
            "Durum"=>$this->resource->status->name,
            "Yetenekler" => SkillResource::collection($this->resource->user->skills ?? collect())
        ];
    }
}
