<?php
    namespace App\CustomData;

    use Kakaprodo\CustomData\CustomData;

    class NotificationData extends CustomData {
        protected function expectedProperties(): array {
            return [
                'title' => $this->dataType()->string(),
                'body' => $this->dataType()->string()
            ];
        }
    }
