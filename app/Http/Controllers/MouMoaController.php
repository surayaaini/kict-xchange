<?php

namespace App\Http\Controllers;

use App\Models\MouMoa;
use Illuminate\Http\Request;

class MouMoaController extends Controller
{
    public function index(Request $request)
    {
        $query = MouMoa::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('collaborator', 'like', '%' . $request->search . '%')
                  ->orWhere('focal_person', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting logic
        $sortable = ['collaborator', 'signed_date', 'expiry_date', 'focal_person', 'type', 'impact'];
        $sort = $request->get('sort');
        $direction = $request->get('direction') === 'desc' ? 'desc' : 'asc';

        if (in_array($sort, $sortable)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('signed_date', 'desc'); // default sort
        }

        $moumoas = $query->get();

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

