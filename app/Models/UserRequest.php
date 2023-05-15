<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class UserRequest extends Model {
        use HasFactory;

        const WRITTE = "become-writter";

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'user_id',
            'request',
        ];

        /**
         * User requests belongs to user
         * @return BelongsTo
         */
        public function user() {
            return $this->belongsTo(User::class);
        }
    }
