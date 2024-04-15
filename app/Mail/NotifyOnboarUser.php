<?php

    namespace App\Mail;

    use App\Models\User;
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    class NotifyOnboarUser extends Mailable implements ShouldQueue {
        use Queueable, SerializesModels;

        protected User $user;

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
            return $this->from('noreply@norldverse.patienceman.com', 'Norldverse')
                        ->subject('Welcome to Norldverse - blogs')
                        ->view('emails.new_user')
                        ->with('user', $this->user);
        }
    }
