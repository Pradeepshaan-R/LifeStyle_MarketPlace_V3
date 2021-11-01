<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Enums;

class Client extends Model
{
    use HasFactory, Enums;

    protected $fillable = [
        'type',
        'status',
        'company_name',
        'company_email',
        'company_website',
        'company_address',
        'company_city',
        'company_pv_no',
        'company_phone',
        'company_legal_type',
        'country_id',
        'tenant_id',
        'user_id',
    ];

    public static $rules = [
        'type' => 'required',
        'name' => 'required',
        'email' => 'required',
    ];

    

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function user()
    {
        return $this->hasOne('App\Domains\Auth\Models\User');
    }

    public function tenant()
    {
        return $this->belongsTo('App\Models\Tenant');
    }
}
