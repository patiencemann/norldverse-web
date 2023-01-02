<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    use Illuminate\Support\Str;

    class Doc extends Model {
        use HasFactory;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'user_id',
            'title',
            'caption',
            'contents',
            'status'
        ];

        protected static function boot() {
            parent::boot();

            /**
             * Generate doc slug
             */
            static::creating(function ($doc) {
                $doc->slug = Str::lower(Str::slug($doc->title)."_".Str::random(10));
            });
        }

        /**
         * Doc belongs to user
         *
         * @return BelongsTo
         */
        public function user(): BelongsTo {
            return $this->belongsTo(User::class);
        }

        /**
         * Doc HasMany comments
         *
         * @return HasMany
         */
        public function docComments(): HasMany {
            return $this->hasMany(DocComment::class);
        }

        /**
         * Doc HasMany media
         *
         * @return HasOne
         */
        public function docMedia(): HasOne {
            return $this->hasOne(DocMedia::class);
        }
    }
