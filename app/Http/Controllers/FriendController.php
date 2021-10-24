<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\RequestFriend;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index()
    {
        return view('friends.index', [
            'title'            => 'Friends',
            'incomingRequests' => RequestFriend::where('to_id', auth()->user()->id)->get(),
            'pendingRequests'  => RequestFriend::where('from_id', auth()->user()->id)->get(),
            'friendList'       => Friend::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function addFriend(Request $request)
    {
        $request->validate([
            'username' => 'required'
        ]);

        $user = User::where('username', strtolower($request->username))->first();
        if (!$user || auth()->user()->username === strtolower($request->username)) {
            return back()->with('message', [
                'icon'  => 'error',
                'title' => 'Username',
                'text'  => 'does not exist'
            ])->withInput();
        }

        if (Friend::where('user_id', auth()->user()->id)->where('friend_id', $user->id)->first()) {
            return back()->with('message', [
                'icon'  => 'error',
                'title' => 'Username',
                'text'  => 'is already on the friend list'
            ])->withInput();
        }

        if (RequestFriend::where('from_id', auth()->user()->id)->where('to_id', $user->id)->first()) {
            return back()->with('message', [
                'icon'  => 'error',
                'title' => 'Username',
                'text'  => 'is already on the friend request'
            ])->withInput();
        }

        RequestFriend::create([
            'from_id' => auth()->user()->id,
            'to_id'   => $user->id
        ]);

        return back()->with('message', [
            'icon'  => 'success',
            'title' => 'Request Friend',
            'text'  => 'added successfully'
        ]);
    }

    public function store($id)
    {
        $requestFriend = RequestFriend::find($id);
        RequestFriend::destroy($id);
        Friend::create([
            'user_id'   => $requestFriend->from_id,
            'friend_id' => $requestFriend->to_id,
        ]);

        Friend::create([
            'user_id'   => $requestFriend->to_id,
            'friend_id' => $requestFriend->from_id,
        ]);

        return back()->with('message', [
            'icon'  => 'success',
            'title' => 'Friend',
            'text'  => 'added successfully'
        ]);
    }

    public function delete($id)
    {
        RequestFriend::destroy($id);
        return back()->with('message', [
            'icon'  => 'success',
            'title' => 'Request Friend',
            'text'  => 'deleted successfully'
        ]);
    }
}
