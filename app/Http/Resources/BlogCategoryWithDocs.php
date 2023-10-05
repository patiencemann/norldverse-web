<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;
    use App\Http\Resources\Public\DocResource;

    class BlogCategoryWithDocs extends JsonResource {
        /**
         * Transform the resource into an array.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
         */
        public function toArray($request) {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'blogs' => DocResource::collection($this->blogs),
                'created_at' => $this->created_at->toDateTimeString(),
            ];
        }
    }
