<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Support\Str;

    class DocComment extends Model {
        use HasFactory;

         /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'doc_id',
            'user_id',
            'message',
            'status'
        ];

        protected static function boot() {
            parent::boot();

            /**
             * Generate doc slug
             */
            static::creating(function ($comment) {
                $comment->slug = Str::lower(Str::slug($comment->user->name)."_comment_".Str::random(10));
            });
        }

        /**
         * Commects belongs to doc
         *
         * @return BelongsTo
         */
        public function doc(): BelongsTo {
            return $this->belongsTo(Doc::class);
        }

        /**
         * Comment belongs to user
         *
         * @return BelongsTo
         */
        public function user(): BelongsTo {
            return $this->belongsTo(User::class);
        }
    }
