<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VagonApp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id', 'vagon_stream_url','vagon_app_id', 'region','note', 'status', 'created_user_id', 'updated_user_id', 'server'
    ];

    public function user() {
        return $this->belongsTo('\App\User', 'user_id', 'id');
    }
}
