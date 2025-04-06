<?php

namespace App\Http\Controllers;

use App\Models\MouMoa;
use Illuminate\Http\Request;

class MouMoaController extends Controller
{
    public function index(Request $request)
    {
        $query = MouMoa::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('collaborator', 'like', "%{$search}%")
                ->orWhere('focal_person', 'like', "%{$search}%");
        }

        $moumoas = $query->orderBy('signed_date', 'desc')->get();

        return view('moumoa.index', compact('moumoas'));
    }



    public function create()
    {
        return view('moumoa.create'); // Admin-only form
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'collaborator' => 'required|string|max:255',
            'signed_date' => 'required|date',
            'expiry_date' => 'nullable|date|after_or_equal:signed_date',
            'focal_person' => 'required|string|max:255',
            'type' => 'required|in:MoU,MoA',
            'impact' => 'required|string|max:255',
        ]);

        MouMoa::create($validated);
        return redirect()->route('moumoa.index')->with('success', 'MOU/MOA added successfully!');
    }

    public function edit($id)
    {
        $moumoa = MouMoa::findOrFail($id);
        return view('moumoa.edit', compact('moumoa'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'collaborator' => 'required|string|max:255',
            'signed_date' => 'required|date',
            'expiry_date' => 'nullable|date|after_or_equal:signed_date',
            'focal_person' => 'required|string|max:255',
            'type' => 'required|in:MoU,MoA',
            'impact' => 'required|string|max:255',
        ]);

        MouMoa::findOrFail($id)->update($validated);
        return redirect()->route('moumoa.index')->with('success', 'MOU/MOA updated successfully.');
    }

    public function destroy($id)
    {
        MouMoa::findOrFail($id)->delete();
        return redirect()->route('moumoa.index')->with('success', 'MOU/MOA deleted successfully.');
    }
}

