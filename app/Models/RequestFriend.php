<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestFriend extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}
