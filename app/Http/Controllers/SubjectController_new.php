<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin_or_staff')->except('index');
    }

    public function index()
    {
        $subjects = Subject::orderBy('subject_id', 'desc')->get();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:subjects',
            'title' => 'required|string|max:100',
            'unit' => 'required|integer|min:1',
        ]);

        Subject::create($validated);
        return redirect()->route('subjects.index')->with('success', 'Subject created successfully');
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:subjects,code,' . $subject->subject_id . ',subject_id',
            'title' => 'required|string|max:100',
            'unit' => 'required|integer|min:1',
        ]);

        $subject->update($validated);
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully');
    }
}
