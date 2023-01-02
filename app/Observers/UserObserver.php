<?php

    namespace App\Observers;

    use App\Models\Role;
    use App\Models\User;

    class UserObserver {
        /**
         * Handle the User "created" event.
         *
         * @param  \App\Models\User  $user
         * @return void
         */
        public function created(User $user) {
            if(!$user->hasRole(Role::USER))
                $user->attachRole(Role::USER);
        }

        /**
         * Handle the User "deleted" event.
         *
         * @param  \App\Models\User  $user
         * @return void
         */
        public function deleted(User $user) {
            $user->detachRoles($user->roles);
        }
    }
