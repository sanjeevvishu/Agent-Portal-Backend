<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuVerse extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'cu_verse_category_id', 'language', 'title', 'caption', 'file_name', 'file_size', 'file_mime_type', 'file_s3_path', 'visibility', 'status', 'created_user_id', 'updated_user_id'];
    
   
    // public function getFileS3PathAttribute($value)
    // {
    //     return str_replace('+', '%2B', $value);
    // }

    public function category() {
        return $this->belongsTo(CuVerseCategory::class, 'cu_verse_category_id', 'id');
    }


    public function parent()
    {
        return $this->belongsTo(CuVerse::class,'cu_verse_category_id')->where('cu_verse_category_id',0)->with('parent');
    }

    public function children()
    {
        return $this->hasMany(CuVerse::class,'cu_verse_category_id')->with('category');
    }

}
