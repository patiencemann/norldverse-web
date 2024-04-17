<?php

    namespace App\Mail;

    use Illuminate\Bus\Queueable;
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
            return $this->markdown('emails.new_doc')->subject($this->doc->title);
        }
    }
