<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'business_activity',
        'contact_customer_id',
        'contact_position',
        'staff_size_exact',
        'staff_size_range_from',
        'staff_size_range_to',
        'notes',
    ];

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
