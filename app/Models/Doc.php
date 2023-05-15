<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    use Illuminate\Support\Str;
    use Patienceman\Filtan\Filterable;

    class Doc extends Model {
        use HasFactory,
            Filterable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'user_id',
            'slug',
            'title',
            'caption',
            'contents',
            'status'
        ];

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

        /**
         * Doc has one to topics
         * @return HasOne
         */
        public function docTopic(): HasOne {
            return $this->hasOne(DocTopic::class);
        }

        /**
         * Doc has Many likes
         *
         * @return HasMany
         */
        public function likes(): HasMany {
            return $this->hasMany(DocLike::class);
        }
    }
