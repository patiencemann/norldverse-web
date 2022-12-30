<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;

    class DocCommentResource extends JsonResource {
        /**
         * Transform the resource into an array.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
         */
        public function toArray($request) {
            return [
                'user' => UserResource::make($this->user),
                'doc' => DocResource::make($this->doc),
                'message' => $this->message,
                'created_at' => $this->created_at->format('M d, Y')
            ];
        }
    }
