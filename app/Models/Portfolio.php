<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name','birthday','age'];

    public function experiences() {
        return $this->hasMany(Experience::class);
    }

    public function skills() {
        return $this->hasMany(Skill::class);
    }

    public function qualifications() {
        return $this->hasMany(Qualification::class);
    }

    public function contacts() {
        return $this->hasMany(Contact::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

