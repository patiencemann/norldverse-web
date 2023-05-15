<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class DocLike extends Model {
        use HasFactory;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'user_id',
            'doc_id',
        ];

        /**
         * Like belongs to doc
         * @return BelongsTo
         */
        public function doc() {
            return $this->belongsTo(Doc::class);
        }
    }
