<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\User;
use App\Notifications\ProposalApprovedNotification;
use Illuminate\Support\Facades\Notification;

class AdminProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::latest()->get();
        return view('admin.proposals.index', compact('proposals'));
    }

    public function approve($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->status = 'Approved';
        $proposal->save();

        $staffUser = User::where('email', $proposal->submitted_by_email)->first();

        if ($staffUser) {
            $staffUser->notify(new ProposalApprovedNotification());
        }

        return redirect()->back()->with('success', 'Proposal approved successfully!');
    }

    public function reject($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->status = 'Rejected';
        $proposal->save();

        return redirect()->route('admin.proposals.index')->with('success', 'Proposal has been rejected.');
    }

    public function show($id)
    {
        $proposal = Proposal::findOrFail($id);
        return view('admin.proposals.show', compact('proposal'));
    }



}
