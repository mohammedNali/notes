<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Tag;
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
        $tags = Tag::all();
//        $notes = Note::where('user_id', auth()->id())->latest()->take(5)->get();
        $notes = Note::latest()->take(5)->get();
//        $notes = Note::where('user_id', auth()->id())->latest()->get();

//        $note = Note::where('user_id', auth()->id())->first();
//        $note = Note::find(3);
//        $note = Note::firstWhere('user_id', auth()->id());

//        dd($note);

//        $notes = Note::with('user')->latest()->get();
        return view('notes.index', [
            'notes' => $notes,
            'tags' => $tags
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
            'content' => 'required|string|max:255',
            'tags' => 'nullable|array'
        ]);


//        $request->user()->notes()->create($validated);

        $note = Note::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => auth()->id()
        ]);

        if (isset($validated['tags'])) {
//            $note->tags()->attach($validated['tags']);
            $note->tags()->syncWithoutDetaching($validated['tags']);
        }


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
            'content' => 'required|string|max:255',
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
