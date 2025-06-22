<?php

namespace Branzia\Customer\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        'customer_id',
        'first_name',
        'last_name',
        'company',
        'street_address_1',
        'street_address_2',
        'city',
        'region',
        'postcode',
        'country_code',
        'telephone',
        'is_default_billing',
        'is_default_shipping',
    ];

    protected $casts = [
        'is_default_billing' => 'boolean',
        'is_default_shipping' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}