<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_type',
        'insurance_company',
        'contract_number',
        'is_signed',
        'signed_at',
        'payment_frequency',
        'net_value',
        'contract_category',
        'policy_holder_id',
        'company_id',
    ];

    protected $casts = [
        'is_signed' => 'boolean',
        'signed_at' => 'date',
        'net_value' => 'decimal:2',
    ];

    public function policyHolder()
    {
        return $this->belongsTo(Customer::class, 'policy_holder_id');
    }

    public function insuredCustomers()
    {
        return $this->belongsToMany(
            Customer::class,
            'contract_insured_customers',
            'contract_id',
            'customer_id'
        );
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
