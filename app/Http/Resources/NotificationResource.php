<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;

    class NotificationResource extends JsonResource {
        /**
         * Transform the resource into an array.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
         */
        public function toArray($request) {
            return [
                'id' => $this->id,
                'header' => $this->data['header'],
                'message' => $this->data['message'],
                'readed' => ($this->read_at) ? true : false,
                'action' => $this->data['action'],
                'app_url' => env('APP_URL'),
                'created_at' => $this->created_at->toDateTimeString()
            ];
        }
    }
