<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class BlogCategory extends Model {
        use HasFactory;

        protected $fillable = [
            'name', 'active_status'
        ];

        public function blogs() {
            return $this->hasMany(Doc::class);
        }
    }
