<?php

namespace App\Http\Controllers;

use App\Models\MouMoa;
use Illuminate\Http\Request;

class MouMoaController extends Controller
{
    public function index()
    {
        $moumoas = MouMoa::all();
        return view('moumoa.index', compact('moumoas'));
    }

    public function create()
    {
        return view('moumoa.create'); // Admin-only form
    }

    public function store(Request $request)
    {
        $request->validate([
            'university_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'details' => 'nullable|string',
        ]);

        MouMoa::create($request->all());
        return redirect()->route('moumoa.index')->with('success', 'MOU/MOA added successfully.');
    }

    public function edit($id)
    {
        $moumoa = MouMoa::findOrFail($id);
        return view('moumoa.edit', compact('moumoa'));
    }

    public function update(Request $request, $id)
    {
        $moumoa = MouMoa::findOrFail($id);
        $moumoa->update($request->all());
        return redirect()->route('moumoa.index')->with('success', 'MOU/MOA updated successfully.');
    }

    public function destroy($id)
    {
        MouMoa::findOrFail($id)->delete();
        return redirect()->route('moumoa.index')->with('success', 'MOU/MOA deleted successfully.');
    }
}