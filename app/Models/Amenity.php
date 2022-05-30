<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 's3_icon_path', 'status', 'created_user_id', 'updated_user_id'];
    
    protected $appends = ['media_s3_base_path'];

    public function getMediaS3BasePathAttribute() {
        return 'https://cuengine-portal.s3.eu-west-2.amazonaws.com/';
    }

}
