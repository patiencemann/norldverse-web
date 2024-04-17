<?php

    namespace App\Jobs;

    use App\Mail\NewDocEmail;
    use App\Models\Doc;
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Mail;

    class ProcessNewDocEmails implements ShouldQueue {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        public $doc;

        /**
         * Create a new job instance.
         *
         * @return void
         */
        public function __construct(Doc $doc) {
            $this->doc = $doc;
        }

        /**
         * Execute the job.
         *
         * @return void
         */
        public function handle() {
            $newsletterEmails = DB::table('newsletters')->select('email')->where('unsubscribed', false)->distinct()->get();

            $newsletterEmails->chunk(100, function ($users) {
                foreach ($users as $user) {
                    Mail::to($user->email)->send(new NewDocEmail($this->doc));
                }
            });
        }
    }
