<?php

namespace App\Models;

use App\Enums\Team\TeamTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Team extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'type',
        'active',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    /** @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<User>*/
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /** @return array<string,mixed>*/
    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    /**
     * @return array<string, class-string>
     */
    public function enums(): array
    {
        return [
            'type' => TeamTypeEnum::class,
        ];
    }
}
