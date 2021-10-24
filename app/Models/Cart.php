<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public static function containDeletedAdmin()
    {
        return DB::table('carts')
            ->join('games', 'carts.game_id', '=', 'games.id')
            ->select('games.deleted_admin')
            ->where('games.deleted_admin', 1)
            ->where('carts.user_id', auth()->user()->id)
            ->first();
    }
}
