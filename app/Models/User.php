<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'code',
        'details',
        'hospital_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'details' => 'json'
    ];

    protected $appends = [
        'notify_count',
        'notifications'
    ];

    public function getNotifyCountAttribute()
    {
        return Notification::where('user_id', Auth::id())->whereDate('expired_at', '>=', Carbon::today()->toDateString())->where('read', false)->count();
    }

    public function getNotificationsAttribute()
    {
        return Notification::where('user_id', Auth::id())->whereDate('expired_at', '>=', Carbon::today()->toDateString())->orderBy('id', 'desc')->get();
    }
    public function hospital()
    {
        return $this->hasOne(Hospital::class, 'id', 'hospital_id');
    }

    public function getAgeAttribute() //add user->age column when getting data for real time age
    {
        return isset($this->details['birthday']) ? Carbon::parse($this->details['birthday'])->age : $this->details['age'] ?? '';
    }

}
