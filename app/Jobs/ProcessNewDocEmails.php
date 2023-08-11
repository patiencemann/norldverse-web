<?php

    namespace App\Jobs;

    use App\Mail\NewDocEmail;
    use App\Models\Doc;
    use App\Models\User;
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldBeUnique;
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
            $userEmails = DB::table('users')->select('email')->distinct()->get();
            $newsletterEmails = DB::table('newsletters')->select('email')->distinct()->get();
            $combinedEmails = $userEmails->union($newsletterEmails);

            $combinedEmails->chunk(100, function ($users) {
                foreach ($users as $user) {
                    Mail::to($user->email)->send(new NewDocEmail($this->doc));
                }
            });
        }
    }
