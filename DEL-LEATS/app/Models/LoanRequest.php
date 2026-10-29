<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    protected $table = 'loan_requests';

    protected $fillable = [
        'equipment_id',
        'borrower_name',
        'borrower_nim',
        'borrower_email',
        'loan_date',
        'expected_return_date',
        'purpose',
        'status',
        'total_estimated_fee',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }
}
