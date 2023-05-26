<?php
    namespace App\CustomData;

    use Kakaprodo\CustomData\CustomData;

    class NewsRSS extends CustomData {
        protected function expectedProperties(): array {
            return [
                'slug' => $this->dataType()->string(),
                'meta_title' => $this->dataType()->string(),
                'meta_description' => $this->dataType()->string(),
                'published_at' => $this->dataType()->string(),
                'absolute_url' => $this->dataType()->string(),
                'image_url' => $this->dataType()->string(),
                'html' => $this->dataType()->string(),
                'author' => $this->dataType()->string(),
                'category' => $this->dataType()->string()
            ];
        }
    }
