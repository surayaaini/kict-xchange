<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;

class AdminProposalController extends Controller
{
    public function index()
    {
        // Load all proposals (for admin)
        $proposals = Proposal::latest()->get();

        return view('admin.proposals.index', compact('proposals'));
    }

    public function approve($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->status = 'Approved';
        $proposal->save();

        return redirect()->route('admin.proposals.index')->with('success', 'Proposal approved successfully!');
    }

    public function reject($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->status = 'Rejected';
        $proposal->save();

        return redirect()->route('admin.proposals.index')->with('success', 'Proposal rejected successfully!');
    }

}
