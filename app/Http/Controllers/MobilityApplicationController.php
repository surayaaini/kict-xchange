<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MobilityApplication;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;

class MobilityApplicationController extends Controller
{
    public function create($proposal_id)
    {
        $proposal = Proposal::findOrFail($proposal_id);
        return view('mobility_application.create', compact('proposal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // You can fine-tune this later per field type
            'full_name' => 'required|string',
            'matric_no' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'emergency_name' => 'required|string',
            'emergency_phone' => 'required|string',
            'emergency_relationship' => 'required|string',
            'university' => 'required|string',
            'kulliyyah' => 'required|string',
            'cgpa' => 'required|string',
            'language_proficiency' => 'nullable|string',
            'sponsorship_status' => 'required|string',
            'estimated_cost' => 'nullable|string',
            'mobility_start_date' => 'required|date',
            'mobility_end_date' => 'required|date',
            'programme_name' => 'required|string',
            'purpose' => 'required|string',
            'declaration_agreed' => 'accepted',

            'supporting_files.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $filePaths = [];
        if ($request->hasFile('supporting_files')) {
            foreach ($request->file('supporting_files') as $file) {
                $filePaths[] = $file->store('mobility_applications', 'public');
            }
        }

        MobilityApplication::create([
            ...$validated,
            'user_id' => Auth::id(),
            'proposal_id' => $request->input('proposal_id'),
            'supporting_files' => json_encode($filePaths),
        ]);

        return redirect()->route('dashboard')->with('success', 'Your mobility application has been submitted!');
    }
}
