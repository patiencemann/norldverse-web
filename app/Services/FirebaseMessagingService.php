<?php
    namespace App\Services;

    use App\CustomData\NotificationData;
    use Kreait\Firebase\Messaging\CloudMessage;
    use Kreait\Firebase\Messaging\Notification;
    use Kreait\Firebase\Messaging\ApnsConfig;

    class FirebaseMessagingService {
        public NotificationData $notification;
        public string $topic;

        public function make(string $topic, array $notification) {
            $this->notification = NotificationData::make($notification);
            $this->topic = $topic;
        }

        /**
         * Send Notification to subscribe firebase Devices
         */
        public function push() {
            return CloudMessage::withTarget('topic', $this->topic)
                    ->withNotification(Notification::fromArray($this->notification->all())) // optional
                    ->withLowestPossiblePriority()
                    ->withApnsConfig(
                        ApnsConfig::new()
                            ->withImmediatePriority()
                            ->withNotification($this->notification->all())
                    );
        }
    }
