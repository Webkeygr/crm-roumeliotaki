<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_type',
        'insurance_company',
        'policy_number',
        'is_signed',
        'signed_at',
        'payment_frequency',
        'net_value',
        'policy_kind',
        'policyholder_id',
        'company_id',
    ];

    protected $casts = [
        'is_signed' => 'boolean',
        'signed_at' => 'date',
        'net_value' => 'decimal:2',
    ];

    // Συμβαλλόμενος
    public function policyholder()
    {
        return $this->belongsTo(Customer::class, 'policyholder_id');
    }

    // Εταιρία (για ομαδικά)
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Ασφαλιζόμενοι (πολλοί πελάτες)
    public function insuredCustomers()
    {
        return $this->belongsToMany(Customer::class, 'policy_customer')
                    ->withTimestamps();
    }
}
