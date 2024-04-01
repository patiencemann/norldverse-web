<?php
    namespace App\Notifications;

    use App\Facades\FirebaseMessaging;
    use App\Mail\NewDocEmail;
    use App\Models\User;
    use Illuminate\Support\Facades\Mail;
    use Patienceman\Notifier\NotifyHandler;
    use Patienceman\Notifier\Traits\NotifyPayload;
    use Mailgun\Mailgun;

    class CloudNotification extends NotifyHandler {
        use NotifyPayload;

        /**
         * Execute notification
         * @retxurn mixed
         */
        public function handle() {
            foreach (User::all() as $user) {
                Mail::to($user->email)->send(new NewDocEmail($this->doc));
            }
        }
    }
