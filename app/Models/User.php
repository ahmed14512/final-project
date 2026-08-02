<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        
        'name',
        'email',
        'password',
        'phone',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole(string $role): bool
    {
        return $this->roles->pluck('name')->contains($role);
    }

    public function hasAnyRole(array $roles): bool
    {
        return $this->roles->pluck('name')
                    ->intersect($roles)
                    ->isNotEmpty();

    }

    public function isAdmin() : bool
    {
        return $this->hasAnyRole(['admin', 'super_admin']);
    }

    public function isCustomer(): bool
    {
        return $this->hasRole('customer');
    }

    public function isStaff(): bool
    {
        return $this->hasRole('staff');
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }


public function getRoleNameAttribute(): string
{
    return $this->roles->first()?->name ?? 'customer';
}

public function orders()
{
    return $this->hasMany(Order::class);
}

}
