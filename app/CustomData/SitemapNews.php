<?php
    namespace App\CustomData;

    use Kakaprodo\CustomData\CustomData;

    class SitemapNews extends CustomData {
        protected function expectedProperties(): array {
            return [
                'absolute_url' => $this->dataType()->string(),
                'published_at' => $this->dataType()->string(),
                'meta_title' => $this->dataType()->string(),
                'website' => $this->dataType()->string(),
                'language' => $this->dataType()->string()
            ];
        }
    }
