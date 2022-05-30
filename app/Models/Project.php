<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [ 'title', 'slug', 'small_description', 'medium_description', 'long_description', 'meta_title', 'meta_description', 'meta_keywords', 'logo_image', 'featured_image', 'address', 'city', 'state', 'country', 'zip_code', 'latitude', 'longitude','google_map_embed', 'google_map_shortlink', 'amenities', 'property_stage', 'property_area', 'property_type', 'unit_type', 'min_price', 'max_price', 'min_built_up_area', 'max_built_up_area', 'is_2d_enabled', 'is_3d_enabled', 'is_single_building','portal_2d_url', 'currency_symbol', 'status', 'is_featured', 'created_user_id', 'updated_user_id',];

    protected $casts = [
       'amenities' => 'array'
    ];

    protected $appends = ['media_s3_base_path'];

    public function getMediaS3BasePathAttribute() {
        return 'https://cuengine-portal.s3.eu-west-2.amazonaws.com/';
    }
    
    public function banners() {
        return $this->hasMany(ProjectMedia::class)->where('asset_type','banner');
    }

    public function gallery() {
        return $this->hasMany(ProjectMedia::class)->where('asset_type','gallery');
    }

    public function floorplan() {
        return $this->hasMany(ProjectMedia::class)->where('asset_type','floorplan');
    }

    public function view() {
        return $this->hasMany(ProjectMedia::class)->where('asset_type','view');
    }
}
