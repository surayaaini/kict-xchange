<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MouMoa; // To get the Partner Universities
use App\Models\Proposal; // (after we create Proposal model soon)
use Illuminate\Support\Facades\Auth;


class ProposalController extends Controller
{
    public function create()
    {
        $moumoas = MouMoa::all();
        return view('proposal.create', compact('moumoas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'submitted_by_name' => 'required|string',
            'submitted_by_email' => 'required|email',
            'submitted_by_phone' => 'required|string',
            'partner_university' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'objective' => 'required|string',
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg',
        ]);

        // Handle documents upload
        $uploadedFiles = [];
        if ($request->hasfile('documents')) {
            foreach ($request->file('documents') as $file) {
                $filename = $file->store('proposals', 'public');
                $uploadedFiles[] = $filename;
            }
        }

        Proposal::create([
            'submitted_by_name' => Auth::user()->name,
            'submitted_by_email' => Auth::user()->email,
            'submitted_by_phone' => $request->submitted_by_phone,
            'partner_university' => $validated['partner_university'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'objective' => $validated['objective'],
            'responsible_staff' => json_encode($request->partner_staff_name),
            'lecturers' => json_encode($request->lecturer_name),
            'students' => json_encode($request->student_name),
            'documents' => json_encode($uploadedFiles),
            'status' => 'Pending',
        ]);

        return redirect()->route('proposal.index')->with('success', 'Proposal submitted successfully!');
    }

    public function index()
    {
        if (Auth::user()->role_id == 1) {
            // Admin: See all proposals
            $proposals = Proposal::latest()->get();
        } else {
            // Staff: Only see their own proposals
            $proposals = Proposal::where('submitted_by_email', Auth::user()->email)->latest()->get();
        }

        return view('proposal.index', compact('proposals'));
    }



}
