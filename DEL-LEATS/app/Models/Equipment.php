<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';

    protected $fillable = [
        'category_id',
        'asset_code',
        'name',
        'specification',
        'condition',
        'status',
        'daily_rental_fee',
        'image_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function loanRequests()
    {
        return $this->hasMany(LoanRequest::class, 'equipment_id');
    }
}
