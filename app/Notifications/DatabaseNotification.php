<?php
    namespace App\Notifications;

    use Patienceman\Notifier\NotifyHandler;
    use Patienceman\Notifier\Traits\NotifyPayload;

    class DatabaseNotification extends NotifyHandler {
        use NotifyPayload;

        /**
         * Execute notification
         * @return mixed
         */
        public function handle() {
            $this->foreachUser(fn($user) => $this->dbNotification($user, $this));
        }

        /**
         * Get the array to database representation of the notification.
         *
         * @param  mixed  $notifiable
         * @return array
         */
        public function toDatabase($notifiable) {
            return [
                'header' => $this->subject,
                'message' => $this->message,
                'action' => $this->action,
            ];
        }
    }
