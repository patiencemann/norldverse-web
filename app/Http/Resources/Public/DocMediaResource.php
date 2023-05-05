<?php

    namespace App\Http\Resources\Public;

    use Illuminate\Http\Resources\Json\JsonResource;

    class DocMediaResource extends JsonResource {
        /**
         * Transform the resource into an array.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
         */
        public function toArray($request) {
            return [
                'id' => $this->id,
                'file_url' => $this->file_url,
                'created_at' => $this->created_at->toDateTimeString()
            ];
        }
    }
