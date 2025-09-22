<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFCMToken extends Model
{
    protected $fillable = [
        'user_id',
        'fcm_token',
        'valido',
        'device_id',
        'platform',
        'topic',
        'last_used_at',
    ];
    protected $table = 'user_fcm_tokens';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
