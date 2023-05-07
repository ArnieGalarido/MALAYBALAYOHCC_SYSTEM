<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referral extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'details' => 'json',
        'referred_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function referring_hospital()
    {
        return $this->hasOne(Hospital::class, 'id', 'referring_id');
    }

    public function referred_hospital()
    {
        return $this->hasOne(Hospital::class, 'id',  'referred_id');
    }
}
