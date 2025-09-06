<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id',
        'qualification_name',
        'institution',
        'year',
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
