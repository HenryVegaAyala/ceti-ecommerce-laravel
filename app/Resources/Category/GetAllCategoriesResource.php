<?php

namespace App\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class GetAllCategoriesResource extends JsonResource
{
    public function toArray($request) {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'name_slug' => Str::slug($this->name)
        ];
    }
}
