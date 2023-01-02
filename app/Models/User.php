<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Laravel\Passport\HasApiTokens;
    use Laratrust\Traits\LaratrustUserTrait;

    class User extends Authenticatable {
        use LaratrustUserTrait;
        use HasApiTokens, HasFactory, Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'name',
            'email',
            'password',
            'provider',
            'provider_id',
            'provider_token',
            'provider_remember_token',
            'email_verified_at',
            'avatar'
        ];

        /**
         * The attributes that should be hidden for serialization.
         *
         * @var array<int, string>
         */
        protected $hidden = [
            'password',
            'remember_token',
        ];

        /**
         * The attributes that should be cast.
         *
         * @var array<string, string>
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];

        /**
         * User hasMany docs
         *
         * @return HasMany
         */
        public function docs(): HasMany {
            return $this->hasMany(Doc::class);
        }

        /**
         * User hasMany comments
         *
         * @return HasMany
         */
        public function docComments(): HasMany {
            return $this->hasMany(DocComment::class);
        }

        /**
         * Get user by id
         *
         * @param Int $userId
         * @return User
         */
        public static function getById(Int $userId) {
            return User::where('id', $userId)->first();
        }
    }
