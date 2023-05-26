<?php
    namespace App\CustomData;

    use Kakaprodo\CustomData\CustomData;

    class Sitemap extends CustomData {
        protected function expectedProperties(): array {
            return [
                'absolute_url' => $this->dataType()->string(),
                'updated_at' => $this->dataType()->string(),
                'change_frequency' => $this->dataType()->string(),
                'priority' => $this->dataType()->numeric()
            ];
        }
    }
