<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'cubedots_id', 'apartment_id', 'status', 'status_id', 'is_reserved', 'price_local', 'price_international', 'built_up_area', 'block', 'floor', 'bedroom', 'checks', 'unit_number', 'unit_id', 'net_area', 'unit_area', 'unit_type', 'layout', 'direction', 'balcony', 'terrace', 'private_parking', 'views', 'is_published', 'created_user_id', 'updated_user_id'];
    
}
