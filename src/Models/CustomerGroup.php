<?php

namespace Branzia\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Branzia\Tax\Models\TaxClass;

class CustomerGroup extends Model
{
    protected $fillable = [
        'code',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

}