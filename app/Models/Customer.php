<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    protected $appends = ['full_name'];

    // Συμβόλαια όπου είναι συμβαλλόμενος
public function policiesAsHolder()
{
    return $this->hasMany(Policy::class, 'policyholder_id');
}

// Συμβόλαια όπου είναι ασφαλιζόμενος
public function policiesAsInsured()
{
    return $this->belongsToMany(Policy::class, 'policy_customer');
}


    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    // θα τα χρησιμοποιήσουμε αργότερα
    public function contractsAsPolicyHolder(): HasMany
    {
        return $this->hasMany(Contract::class, 'policy_holder_id');
    }

    public function contractsAsInsured(): BelongsToMany
    {
        return $this->belongsToMany(Contract::class, 'contract_insured_customers');
    }

    public function familyMembers(): BelongsToMany
    {
        return $this->belongsToMany(
            Customer::class,
            'customer_relations',
            'customer_id',
            'related_customer_id'
        );
    }
}
