<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'details' => 'json',
    ];

    public function referral()
    {
        return $this->belongsTo(Referral::class);
    }

    public function getAgeAttribute() //add patient->age column when getting data for real time age
    {
        return isset($this->details['birthday']) ? Carbon::parse($this->details['birthday'])->age : $this->details['age'] ?? '';
    }
}
