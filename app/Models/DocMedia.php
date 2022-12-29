<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class DocMedia extends Model {
        use HasFactory;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'doc_id',
            'file_url',
            'status'
        ];

        /**
         * DocMedia belongs to Doc
         *
         * @return BelongsTo
         */
        public function doc(): BelongsTo {
            return $this->belongsTo(Doc::class);
        }
    }
