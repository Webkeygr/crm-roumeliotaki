<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function contactPerson()
    {
        return $this->belongsTo(Customer::class, 'contact_customer_id');
    }

    public function employees()
    {
        return $this->hasMany(Customer::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
