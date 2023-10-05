<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class DocView extends Model {
        use HasFactory;

        protected $fillable = [
            'doc_id', 'ip_address'
        ];
    }
