<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'module',
        'action',
        'description',
        'user_id',
        'user_name',
    ];
}