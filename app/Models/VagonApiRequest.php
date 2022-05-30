<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VagonApiRequest extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'user_id', 'application_id', 'request_type', 'request', 'response', 'response_status'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
