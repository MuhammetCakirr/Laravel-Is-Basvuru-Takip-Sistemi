<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "İlan Başlığı"=>$this->resource->post_title,
            "İlan Açıklaması"=>$this->resource->post_description,
            "Ünvan"=>$this->resource->job_title,
            "Konum"=>$this->resource->location,
            "Çalışma Şekli"=>$this->resource->type_of_work,
            "Ücret (Aylık)"=>number_format($this->resource->price, 0, ',', '.') . " ₺",
            "İlan Tarihi"=>Carbon::parse($this->resource->created_at)->format('l, F j, Y'),
            "İlan Sahibi"=>new UserResource($this->whenLoaded('user')),
            "Gerekli Yetenekler"=>RequirementResource::collection($this->whenLoaded('requirements')),
            "Başvurular"=>JobApplicationResource::collection($this->whenLoaded('applications')) ,


        ];
    }
}
