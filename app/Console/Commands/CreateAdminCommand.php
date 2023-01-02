<?php

    namespace App\Console\Commands;

    use App\Services\AdminService;
    use Illuminate\Console\Command;

    class CreateAdminCommand extends Command {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'create:admin';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Create custom admin user';

        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct() {
            parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return int
         */
        public function handle() {
            AdminService::make($this->userData());
            $this->info('Admin created successfully');
        }

        /**
         * Ask user to provide his admin information
         *
         * @return array
         */
        private function userData() {
            $userName = $this->ask('Enter your name: ');
            $email = $this->ask('Enter your email address: ');
            $password = $this->secret('Enter your password : 8 characters : ');
            $confirmPassword = $this->secret('Confirm password: ');

            return [
                'names' => $userName,
                'email' => $email,
                'password' => $password,
                'confirm_password' => $confirmPassword
            ];
        }
    }
