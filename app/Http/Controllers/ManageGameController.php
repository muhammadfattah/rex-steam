<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManageGameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('manage_game.index', [
            'title'      => 'Manage Game',
            'categories' => Game::categories(),
            'games'      => Game::notDeletedAdmin()->filter(array_merge(request(['search', 'category']), ['creator' => auth()->user()->id]))->paginate(8)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage_game.create', [
            'title'      => 'Create Game',
            'categories' => Game::categories()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'             => 'required|unique:games,name,NULL,id,deleted_admin,0',
            'description'      => 'required|max:500',
            'long_description' => 'required|max:2000',
            'category'         => 'required',
            'developer'        => 'required',
            'publisher'        => 'required',
            'price'            => 'required|numeric|max:1000000',
            'cover'            => 'required|file|mimes:jpg|max:100',
            'trailer'          => 'required|file|mimes:webm|max:102400',
        ]);

        $validatedData['user_id']   = auth()->user()->id;
        $validatedData['cover']     = $request->cover->store('public/cover');
        $validatedData['trailer']   = $request->trailer->store('public/trailer');
        $validatedData['for_adult'] = $request->for_adult == 'true' ? 1 : 0;
        Game::create($validatedData);

        return redirect('/manage-game')->with('message', [
            'icon'  => 'success',
            'title' => 'Game',
            'text'  => 'added successfully'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$game = Game::findByIdAndCreator($id, auth()->user()->id)) {
            abort(403);
        }
        return view('manage_game.edit', [
            'title'      => 'Edit Game',
            'game'       => $game,
            'categories' => Game::categories()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'             => 'required|unique:games,name,' . $id . ',id,deleted_admin,0',
            'description'      => 'required|max:500',
            'long_description' => 'required|max:2000',
            'category'         => 'required',
            'developer'        => 'required',
            'publisher'        => 'required',
            'price'            => 'required|numeric|max:1000000',
            'cover'            => 'file|mimes:jpg|max:100',
            'trailer'          => 'file|mimes:webm|max:102400',
        ]);
        if (!$oldDataGame = Game::findByIdAndCreator($id, auth()->user()->id)) {
            abort(403);
        }
        if (isset($validatedData['cover'])) {
            $validatedData['cover'] = $request->cover->store('public/cover');
            Storage::delete($oldDataGame->cover);
        }
        if (isset($validatedData['trailer'])) {
            $validatedData['trailer'] = $request->trailer->store('public/trailer');
            Storage::delete($oldDataGame->trailer);
        }
        $validatedData['for_adult'] = $request->for_adult == 'true' ? 1 : 0;

        $oldDataGame->update($validatedData);

        return redirect('/manage-game')->with('message', [
            'icon'  => 'success',
            'title' => 'Game',
            'text'  => 'updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Game::find($id)->update([
            'deleted_admin' => 1
        ]);
        return redirect('/manage-game')->with('message', [
            'icon'  => 'success',
            'title' => 'Game',
            'text'  => 'deleted successfully'
        ]);
    }
}
