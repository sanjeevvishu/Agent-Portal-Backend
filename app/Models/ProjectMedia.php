<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProjectMedia extends Model
{
    use HasFactory;

    protected $fillable = [ 'project_id', 'asset_type', 'file_name', 'file_size', 'file_mime_type', 'local_path', 's3_path', 'digi_path', 'category', 'created_user_id', 'updated_user_id'];

    public function getImageLocalPathAttribute($value)
    {
        if ($value) {

            return Storage::disk('s3')->url($value);
        }

        return "https://source.unsplash.com/96x96/daily";
    }

    public function getLocalPathAttribute($value)
    {
        return str_replace('+', '%2B', $value);
    }

    public function getS3PathAttribute($value)
    {
        return str_replace('+', '%2B', $value);
    }
    
    protected $appends = ['media_s3_base_path'];

    public function getMediaS3BasePathAttribute() {
        // if(!empty($this->attributes['local_path'])){
        //     return Storage::disk('s3')->url($this->attributes['local_path']);
        // }
        
        return 'https://cuengine-portal.s3.eu-west-2.amazonaws.com/';
    }

}
