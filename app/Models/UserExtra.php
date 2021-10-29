<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExtra extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne('App\Domains\Auth\Models\User');
    }
    
    public function tenant()
    {
        return $this->belongsTo('App\Models\Tenant');
    }
}