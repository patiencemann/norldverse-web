<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Notifications\DatabaseNotification;

    class Notification extends DatabaseNotification {

        public function users(): BelongsTo {
            return $this->belongsTo(User::class, 'notifiable_id');
        }

    }
