<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\UserRole;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'date_of_birth',
        'gender',
        'email',
        'password',
        'provider',
        'provider_id',
        'image',
        'address',
        'phone',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasOne(Order::class, 'user_id');
    }

    public function evaluates()
    {
        return $this->hasMany(Evaluates::class, 'user_id');
    }

    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function scopeUserRole($query)
    {
        return $query->where('role','!=', UserRole::getKey(UserRole::ADMIN));
    }

    /**
     * Check user is Admin?
     */
    public function isAdmin() {
        return $this->role == UserRole::getKey(0);
    }
    
    public function scopeGetThisYear($query)
    {
        return $query->whereYear('created_at', date("Y"));
    }
    
    public function scopeGetThisMonth($query)
    {
        return $query->whereMonth('created_at', date("m"));
    }

    public function scopeGetCountUsers($query) 
    {
        return $query->selectRaw('COUNT(*) as count_users')
            ->whereRaw('YEAR(created_at) = ' . date('Y'))
            ->groupByRaw('MONTH(created_at)');
    }

    public function scopeGetCountMonth($query)
    {
        return $query->selectRaw('MONTH(created_at) as month')
            ->whereRaw('YEAR(created_at) = ' . date('Y'))
            ->groupByRaw('MONTH(created_at)');
    }
}
