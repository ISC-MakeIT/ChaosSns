<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'description',
        'icon',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class);
    }

    public function toArrayForLoggedInUser(): array
    {
        return [
            'id'          => $this->id,
            'email'       => $this->email,
            'name'        => $this->name,
            'description' => $this->description,
            'icon'        => $this->icon,
            'created_at'  => (new CarbonImmutable($this->created_at))->format('Y/m/d'),
            'updated_at'  => (new CarbonImmutable($this->updated_at))->format('Y/m/d'),
            'tweets'      => $this->tweets,
        ];
    }

    public function toArrayForNormalUser(): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'icon'        => $this->icon,
            'created_at'  => (new CarbonImmutable($this->created_at))->format('Y/m/d'),
            'updated_at'  => (new CarbonImmutable($this->updated_at))->format('Y/m/d'),
            'tweets'      => $this->tweets,
        ];
    }
}
