<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes; // Nâo apaga, edita o delete_at

    public function user() {
        return $this->belongsTo(User::class);
    }
}
