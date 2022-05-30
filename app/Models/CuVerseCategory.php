<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CuVerseCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'description', 'status', 'created_user_id', 'updated_user_id'];

    public function cuVerseMedia() {
        return $this->belongsMany(CuVerse::class, 'cu_verse_category_id');
    }
}
