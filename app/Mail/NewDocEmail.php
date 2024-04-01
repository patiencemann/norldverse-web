<?php

    namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    class NewDocEmail extends Mailable {
        use Queueable, SerializesModels;

        public $doc;

        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct($doc) {
            $this->doc = $doc;
        }

        /**
         * Build the message.
         *
         * @return $this
         */
        public function build(){
            return $this->from('noreply@norldverse.patienceman.com', 'Norldverse')
                    ->subject($this->doc->title)
                    ->view('emails.new_doc')
                    ->with('data', $this->doc);
        }
    }
