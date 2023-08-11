<?php

    namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    class NewsletterEmail extends Mailable {
        use Queueable, SerializesModels;

        public $emailData;

        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct($emailData) {
            $this->emailData = $emailData;
        }

        /**
         * Build the message.
         *
         * @return $this
         */
        public function build() {
            return $this->subject($this->emailData['title'])
                        ->view('emails.newsletter')
                        ->with('data', $this->emailData);
        }
    }
