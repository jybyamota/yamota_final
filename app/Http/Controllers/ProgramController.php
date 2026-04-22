<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('program_id', 'desc')->get();
        return view('programs.index', compact('programs'));
    }

    public function create()
    {
        return view('programs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:programs',
            'title' => 'required|string|max:100',
            'years' => 'required|integer|min:1',
        ]);
        Program::create($validated);
        return redirect()->route('programs.index')->with('success', 'Program created');
    }

    public function edit(Program $program)
    {
        return view('programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'code' => 'required|unique:programs,code,' . $program->program_id . ',program_id',
            'title' => 'required|string|max:100',
            'years' => 'required|integer|min:1',
        ]);
        $program->update($validated);
        return redirect()->route('programs.index')->with('success', 'Program updated');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('programs.index')->with('success', 'Program deleted');
    }
}
