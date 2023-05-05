<?php

    namespace App\Http\Resources\Public;

    use App\Models\User;
    use Illuminate\Http\Resources\Json\JsonResource;

    class DocCommentUserResource extends JsonResource {
        /**
         * Transform the resource into an array.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
         */
        public function toArray($request) {
            return [
                'user' => UserResource::make(User::getById($this->user_id)),
            ];
        }
    }
