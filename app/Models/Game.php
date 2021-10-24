<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Game extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function categories()
    {
        return [
            'Idle',
            'Horror',
            'Adventure',
            'Action',
            'Sports',
            'Strategy',
            'Role-Playing',
            'Puzzle',
            'Simulation',
        ];
    }

    public static function findByIdAndCreator($id, $creator_id)
    {
        if (count($game = DB::table('games')->where('id', $id)->where('user_id', $creator_id)->where('deleted_admin', 0)->get()) > 0) {
            return $game[0];
        } else return null;
    }

    public static function findByGameName($name)
    {
        if (count($game = DB::table('games')->where('name', $name)->where('deleted_admin', 0)->get()) > 0) {
            return $game[0];
        } else return null;
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            $i = 0;
            foreach ($category as $c) {
                if ($i == 0) {
                    $query->where('category', $c);
                    $i++;
                } else {
                    $query->orWhere('category', $c);
                }
            }
            return $query;
        });

        $query->when($filters['creator'] ?? false, function ($query, $creator) {
            return $query->where('user_id', $creator);
        });
    }

    public function scopeNotDeletedAdmin($query)
    {
        return $query->where('deleted_admin', 0);
    }
}
