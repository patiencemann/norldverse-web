<?php

    namespace App\Console\Commands;

    use App\Models\Role;
    use App\Models\User;
    use App\Services\AdminService;
    use Exception;
    use Illuminate\Console\Command;

    class AssignAdminCommand extends Command {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'assign:admin {user?}';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Assign admin role to user by id';

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
            AdminService::checkAlreadyExists();

            $user = User::where('id', $this->argument('user'))->first();

            if(!$user) throw new Exception('user not found');

            $user->attachRole(Role::ADMIN);

            $this->info("Admin created successfully");
        }
    }
