<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function index()
    {
        $skills = JournalEntry::where('user_id', Auth::id())->where('type', 'skill')->get();
        $goals = JournalEntry::where('user_id', Auth::id())->where('type', 'goal')->get();
        $todos = JournalEntry::where('user_id', Auth::id())->where('type', 'todo')->get();

        return view('jurnal.index', compact('skills', 'goals', 'todos'));
    }

    public function markAsDone($id)
    {
        $entry = JournalEntry::findOrFail($id);
        $entry->completed_at = now();
        $entry->save();

        return response()->json(['message' => 'Todo marked as done!']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:skill,goal,todo',
            'content' => 'required|string',
            'date' => 'nullable|date'
        ]);

        $entry = JournalEntry::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'content' => $request->content,
            'date' => $request->date,
        ]);

        return response()->json(['message' => 'Entry added successfully!', 'id' => $entry->id]);
    }

    public function destroy($id)
    {
        $entry = JournalEntry::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$entry) {
            return response()->json(['message' => 'Entry not found or unauthorized'], 404);
        }

        $entry->delete();

        return response()->json(['message' => 'Entry removed successfully!']);
    }
}
