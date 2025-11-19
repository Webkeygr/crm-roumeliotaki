<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'reason',
        'reason_detail',
        'date',
        'time',
        'location',
        'status',
        'insurance_company',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    // Χρήσιμα στα views
    public static function reasons(): array
    {
        return [
            'Ομαδικό ασφαλιστικό',
            'Ασφάλεια Υγείας',
            'Ασφάλεια Ζωής',
            'Ασφάλεια αυτοκινήτου',
            'Ασφάλεια σπιτιού',
        ];
    }

    public static function statuses(): array
    {
        return [
            'Άκυρο',
            'Σε αναμονή απάντησης',
            'Αίτηση',
            'Υπογραφή συμβολαίου',
        ];
    }

    public static function insuranceCompanies(): array
    {
        return [
            'Interamerican',
            'Groupama',
        ];
    }
}
