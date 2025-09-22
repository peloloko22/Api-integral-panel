<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserSub extends Model
{
    protected $table = 'user_subs';

    protected $fillable = [
        'user_id',
        'sub',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
