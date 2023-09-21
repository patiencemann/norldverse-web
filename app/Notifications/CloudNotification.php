<?php
    namespace App\Notifications;

    use App\Facades\FirebaseMessaging;
    use Patienceman\Notifier\NotifyHandler;
    use Patienceman\Notifier\Traits\NotifyPayload;

    class CloudNotification extends NotifyHandler {
        use NotifyPayload;

        /**
         * Execute notification
         * @return mixed
         */
        public function handle() {
            FirebaseMessaging::make($this->topic, [
                'title' => $this->subject,
                'body' => $this->message,
            ]);
        }
    }
