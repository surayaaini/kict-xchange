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
            'lecturers' => json_encode(array_map(function ($name, $email, $phone) {
                return [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                ];
            }, $request->lecturer_name ?? [], $request->lecturer_email ?? [], $request->lecturer_phone ?? [])),

            'students' => json_encode(array_map(function ($name, $matric, $email, $kulliyyah) {
                return [
                    'name' => $name,
                    'matric_no' => $matric,
                    'email' => $email,
                    'kulliyyah' => $kulliyyah,
                ];
            }, $request->student_name ?? [], $request->student_matric ?? [], $request->student_email ?? [], $request->student_kulliyyah ?? [])),
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

    public function show($id)
    {
        $proposal = Proposal::findOrFail($id);

        return view('proposal.show', compact('proposal'));
    }

    public function destroy($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->delete();

        return redirect()->route('proposal.index')->with('success', 'Proposal withdrawn successfully!');
    }

    public function edit($id)
    {
        $proposal = Proposal::findOrFail($id);
        $moumoas = MouMoa::all(); // in case you need Partner Universities list

        return view('proposal.edit', compact('proposal', 'moumoas'));
    }


    public function update(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        $validated = $request->validate([
            'submitted_by_name' => 'required|string',
            'submitted_by_email' => 'required|email',
            'submitted_by_phone' => 'required|string',
            'partner_university' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'objective' => 'required|string',
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $uploadedFiles = [];
        if ($request->hasfile('documents')) {
            foreach ($request->file('documents') as $file) {
                $filename = $file->store('proposals', 'public');
                $uploadedFiles[] = $filename;
            }
        }

        $proposal->update([
            'submitted_by_name' => $validated['submitted_by_name'],
            'submitted_by_email' => $validated['submitted_by_email'],
            'submitted_by_phone' => $validated['submitted_by_phone'],
            'partner_university' => $validated['partner_university'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'objective' => $validated['objective'],
            'responsible_staff' => json_encode(array_map(function ($name, $email, $position) {
                return [
                    'name' => $name,
                    'email' => $email,
                    'position' => $position,
                ];
            }, $request->partner_staff_name ?? [], $request->partner_staff_email ?? [], $request->partner_staff_position ?? [])),
            'lecturers' => json_encode(array_map(function ($name, $email, $phone) {
                return [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                ];
            }, $request->lecturer_name ?? [], $request->lecturer_email ?? [], $request->lecturer_phone ?? [])),
            'students' => json_encode(array_map(function ($name, $matric, $email, $kulliyyah) {
                return [
                    'name' => $name,
                    'matric_no' => $matric,
                    'email' => $email,
                    'kulliyyah' => $kulliyyah,
                ];
            }, $request->student_name ?? [], $request->student_matric ?? [], $request->student_email ?? [], $request->student_kulliyyah ?? [])),
            'documents' => count($uploadedFiles) > 0 ? json_encode($uploadedFiles) : $proposal->documents,
        ]);

        return redirect()->route('proposal.index')->with('success', 'Proposal updated successfully!');
    }




}
