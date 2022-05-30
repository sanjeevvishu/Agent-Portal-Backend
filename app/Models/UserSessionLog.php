<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSessionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'session_type', 'logged_from', 'ip_address', 'user_agent'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
