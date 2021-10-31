<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Enums;

class UserExtra extends Model
{
    use HasFactory, Enums;
    public $timestamps = false;

    protected $enumTitles = [
        'Mr', 'Ms', 'Mrs', 'Dr', 'Rev',
    ];

    public function user()
    {
        return $this->hasOne('App\Domains\Auth\Models\User');
    }
    
    public function tenant()
    {
        return $this->belongsTo('App\Models\Tenant');
    }
}