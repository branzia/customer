<?php

namespace Branzia\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'customer_group_id',
        'prefix',
        'first_name',
        'last_name',
        'suffix',
        'email',
        'password',
        'date_of_birth',
        'gender',
        'tax',
    ];

    protected $hidden = [
        'password',
    ];

    public function group()
    {
        return $this->belongsTo(CustomerGroup::class, 'customer_group_id');
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

 
}