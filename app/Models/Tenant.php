<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_name',
        'address',
        'city',
        'email',
        'phone',
        'url',
        'started_date',
        'expiry_date',
        'no_of_users',
        'status',
        'plan_id',
        'country_id',
        'settings',
        'features',
    ];

    public static $rules = [
        'tenant_name' => 'required',
        'address' => 'required',
        'city' => 'required',
        'plan_id' => 'required',
    ];

    public function user_extra()
    {
        return $this->hasOne('App\Models\UserExtra');
    }

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }


}
