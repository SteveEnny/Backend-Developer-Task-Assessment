<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'company' => $this->company,
            'company_logo' => $this->company_logo,
            'location' => $this->location,
            'category' => $this->category,
            'salary' => $this->salary,
            'description' => $this->when($request->routeIs('api_v1.jobs.index', 'api_v1.my.jobs.index'),Str::limit($this->description, 50),
                    $this->description
            ),
            'benefits' => $this->benefits,
            'type' => $this->type,
            'work_condition' => $this->work_condition,
        ];
    }
}