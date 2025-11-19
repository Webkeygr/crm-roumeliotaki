<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'birth_date',
        'phone_landline',
        'phone_mobile',
        'marital_status',
        'role_in_family',
        'company_id',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contractsAsPolicyHolder()
    {
        return $this->hasMany(Contract::class, 'policy_holder_id');
    }

    public function contractsAsInsured()
    {
        return $this->belongsToMany(
            Contract::class,
            'contract_insured_customers',
            'customer_id',
            'contract_id'
        );
    }

    public function familyRelations()
    {
        return $this->hasMany(CustomerRelation::class, 'customer_id');
    }

    public function familyMembers()
    {
        return $this->belongsToMany(
            Customer::class,
            'customer_relations',
            'customer_id',
            'related_customer_id'
        );
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
