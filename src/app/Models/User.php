<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /** @return \Illuminate\Database\Eloquent\Relations\HasMany<UserContactMethod>*/
    public function contactMethods(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserContactMethod::class);
    }

    /** @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<UserGroup>*/
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(UserGroup::class);
    }

    /** @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Team>*/
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
}
