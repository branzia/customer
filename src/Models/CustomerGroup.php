<?php

namespace Branzia\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Branzia\Tax\Models\TaxClass;

class CustomerGroup extends Model
{
    protected $fillable = [
        'code',
        'tax_class_id',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function taxClass()
    {
        return $this->belongsTo(TaxClass::class,'tax_class_id');
    }
}