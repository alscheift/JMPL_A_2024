<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoginAttempts extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'last_attempt_at',
        'attempts',
    ];

    protected $casts = [
        'last_attempt_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function increaseLoginAttempts(): void
    {
        $this->attempts++;
        $this->last_attempt_at = now();
        $this->save();
    }

    public function resetLoginAttempts(): void
    {
        $this->attempts = 0;
        $this->last_attempt_at = now();
        $this->save();
    }
}
