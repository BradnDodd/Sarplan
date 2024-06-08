<?php

namespace App\Models;

use App\Enums\User\UserContactMethod\UserContactMethodTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UserContactMethod extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'type',
        'user_id',
        'contact',
        'primary_method_for_type',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();

    }

    /** @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User,UserContactMethod>*/
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return array<string,mixed> */
    protected function casts(): array
    {
        return [
            'type' => UserContactMethodTypeEnum::class,
        ];
    }
}
