<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $notes = Note::all();  // SELECT * FROM notes
        $notes = Note::with('user')->latest()->get();
        return view('notes.index', [
            'notes' => $notes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string|max:255'
        ]);


        $request->user()->notes()->create($validated);


//        Note::create($validated);

//        $note = new Note;
//        $note->title = $validated['title'];
//        $note->content = $validated['content'];
//        $note->save();

        return redirect(route('notes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('notes.edit', [
            'note' => $note
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {

        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string|max:255'
        ]);

        $note->update($validated);

        return redirect(route('notes.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect(route('notes.index'));
    }
}
