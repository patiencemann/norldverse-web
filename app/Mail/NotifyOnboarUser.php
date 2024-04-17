<?php

    namespace App\Mail;

    use App\Models\User;
    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    class NotifyOnboarUser extends Mailable {
        use Queueable, SerializesModels;

        public User $user;

        /**
         * Create a new message instance.
         *
         * @param  User  $user
         * @return void
         */
        public function __construct(User $user) {
            $this->user = $user;
        }

        /**
         * Build the message.
         *
         * @return $this
         */
        public function build() {
            return $this->markdown('emails.new_user')->subject('Welcome to Norldverse - App');
        }
    }
