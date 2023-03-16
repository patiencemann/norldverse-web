<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;

    class DocResource extends JsonResource {
        /**
         * Transform the resource into an array.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
         */
        public function toArray($request) {
            return [
                'id' => $this->id,
                'user' => UserResource::make($this->user),
                'title' => $this->title,
                'caption' => $this->caption,
                'contents' => $this->contents,
                'media' => DocMediaResource::make($this->docMedia),
                'comments' => DocCommentUserResource::collection($this->docComments()->distinct()->select('user_id')->take(5)->get()),
                'created_at' => $this->created_at->diffForHumans()
            ];
        }
    }
