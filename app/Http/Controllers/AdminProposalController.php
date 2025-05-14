<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\User;
use App\Notifications\ProposalApprovedNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MobilityApplicationPromptNotification;
use App\Notifications\MobilityFormNotification;



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

        // Notify the original staff who submitted
        $staffUser = User::where('email', $proposal->submitted_by_email)->first();
        if ($staffUser) {
            $staffUser->notify(new ProposalApprovedNotification());
        }

        // Notify any registered students from the proposal form
        $studentDetails = json_decode($proposal->students, true);

        if ($proposal->students) {
            $students = json_decode($proposal->students, true);

            foreach ($students as $student) {
                if (isset($student['email'])) {
                    $user = User::where('email', $student['email'])->first();

                    if ($user) {
                        $user->notify(new MobilityFormNotification($proposal->id));
                    }
                }
            }
        }


        return redirect()->back()->with('success', 'Proposal approved and notifications sent.');
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
