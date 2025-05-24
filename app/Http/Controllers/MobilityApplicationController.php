<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MobilityApplication;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Notifications\NewMobilityApplicationSubmitted;
use Illuminate\Support\Facades\Storage;
use App\Notifications\MobilityApplicationDecisionNotification;
use Illuminate\Support\Facades\Notification;




class MobilityApplicationController extends Controller
{
    public function create($proposal_id)
    {
        $proposal = Proposal::findOrFail($proposal_id);

        return view('mobility.create', [
            'proposal' => $proposal
        ]);
    }


    public function store(Request $request)
    {
        \Log::info('🏁 store() method triggered');

        try {
            $validated = $request->validate([
                'proposal_id' => 'required|exists:proposals,id',
                'full_name' => 'required|string',
                'declaration_matric' => 'required|string',
                'dob' => 'required|date',
                'home_address' => 'required|string',
                'mailing_address' => 'nullable|string',
                'email' => 'required|email',
                'mobile_no' => 'required|string',
                'nationality' => 'required|string',
                'passport_no' => 'nullable|string',
                'passport_expiry' => 'nullable|date',
                'passport_copy' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

                'emergency_name' => 'required|string',
                'emergency_relationship' => 'required|string',
                'emergency_phone' => 'required|string',
                'emergency_email' => 'required|email',
                'emergency_address' => 'required|string',

                'kulliyyah' => 'required|string',
                'level_of_study' => 'required|string',
                'year_of_study' => 'required|integer',
                'semester' => 'required|integer',
                'programme_name' => 'required|string',
                'cgpa' => 'required|string',

                'language_test' => 'required|string',
                'language_score' => 'required|string',

                'fully_funded' => 'required|string',
                'sponsor' => 'required|string',
                'sponsoring_amount' => 'required|string',

                'mobility_type' => 'required|string',
                'host_institution' => 'required|string',
                'host_country' => 'required|string',
                'mobility_start_date' => 'required|date',
                'mobility_end_date' => 'required|date',

                'declaration_name' => 'required|string',
                'declaration_matric' => 'required|string',
                'declaration_date' => 'required|date',
                'agree_declaration' => 'accepted',
                'indemnity_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            \Log::info('✅ Validation passed');

            // Upload files
            $passportPath = $request->hasFile('passport_copy')
                ? $request->file('passport_copy')->store('mobility_passports', 'public')
                : null;

            $indemnityPath = $request->hasFile('indemnity_file')
                ? $request->file('indemnity_file')->store('mobility_indemnities', 'public')
                : null;

            \Log::info('📦 Attempting to store application to DB...');

            $app = MobilityApplication::create([
                'user_id' => auth()->id(),
                'proposal_id' => $validated['proposal_id'],
                'full_name' => $validated['full_name'],
                'matric_no' => $validated['declaration_matric'],
                'date_of_birth' => $validated['dob'],
                'home_address' => $validated['home_address'],
                'mailing_address' => $validated['mailing_address'],
                'email' => $validated['email'],
                'mobile_no' => $validated['mobile_no'],
                'nationality' => $validated['nationality'],
                'passport_no' => $validated['passport_no'],
                'passport_expiry' => $validated['passport_expiry'],
                'passport_copy' => $passportPath,

                'emergency_name' => $validated['emergency_name'],
                'emergency_relationship' => $validated['emergency_relationship'],
                'emergency_phone' => $validated['emergency_phone'],
                'emergency_email' => $validated['emergency_email'],
                'emergency_address' => $validated['emergency_address'],

                'kulliyyah' => $validated['kulliyyah'],
                'level_of_study' => $validated['level_of_study'],
                'year_of_study' => $validated['year_of_study'],
                'semester' => $validated['semester'],
                'programme_name' => $validated['programme_name'],
                'cgpa' => $validated['cgpa'],

                'language_proficiency' => $validated['language_test'] . ' - ' . $validated['language_score'],

                'fully_funded' => $validated['fully_funded'],
                'sponsor' => $validated['sponsor'],
                'sponsoring_amount' => $validated['sponsoring_amount'],

                'mobility_type' => $validated['mobility_type'],
                'host_institution' => $validated['host_institution'],
                'host_country' => $validated['host_country'],
                'mobility_start_date' => $validated['mobility_start_date'],
                'mobility_end_date' => $validated['mobility_end_date'],

                'student_declaration_name' => $validated['declaration_name'],
                'student_declaration_matric' => $validated['declaration_matric'],
                'student_declaration_date' => $validated['declaration_date'],
                'indemnity_file' => $indemnityPath,
            ]);

            \Log::info('✅ Mobility Application stored successfully', ['id' => $app->id]);

            $adminUsers = \App\Models\User::where('role_id', 1)->get();

            foreach ($adminUsers as $admin) {
                $admin->notify(new \App\Notifications\NewMobilityApplicationSubmitted(
                    auth()->user()->name,
                    $app->host_institution,
                    $app->proposal_id
                ));
            }

            return redirect()->route('mobility.index')->with('success', 'Your mobility application has been submitted!');
        } catch (\Exception $e) {
            \Log::error('❌ Error during form submission', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Something went wrong while submitting your application.');
        }



    }

    public function index()
    {
        $userEmail = Auth::user()->email;
        $userId = Auth::id();

        $matchingProposals = Proposal::where('status', 'Approved')
            ->whereNotNull('students')
            ->get()
            ->filter(function ($proposal) use ($userEmail) {
                $students = json_decode($proposal->students, true);
                foreach ($students as $student) {
                    if (isset($student['email']) && $student['email'] === $userEmail) {
                        return true;
                    }
                }
                return false;
            });

        $application = MobilityApplication::where('user_id', $userId)->latest()->first();

        return view('mobility.index', [
            'proposals' => $matchingProposals,
            'application' => $application
        ]);
    }


    public function uploadDocuments(Request $request)
    {
        $request->validate([
            'acceptance_letter' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'proof_of_sponsorship' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'academic_transcript' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'insurance_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'flight_ticket' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $app = MobilityApplication::findOrFail($request->input('application_id'));

        if ($request->hasFile('acceptance_letter')) {
            $app->acceptance_letter = $request->file('acceptance_letter')->store('mobility_acceptance_letters', 'public');
        }
        if ($request->hasFile('proof_of_sponsorship')) {
            $app->proof_of_sponsorship = $request->file('proof_of_sponsorship')->store('mobility_sponsorships', 'public');
        }
        if ($request->hasFile('academic_transcript')) {
            $app->academic_transcript = $request->file('academic_transcript')->store('mobility_transcripts', 'public');
        }
        if ($request->hasFile('insurance_document')) {
            $app->insurance_document = $request->file('insurance_document')->store('mobility_insurance', 'public');
        }
        if ($request->hasFile('flight_ticket')) {
            $app->flight_ticket = $request->file('flight_ticket')->store('mobility_flight_tickets', 'public');
        }

        $app->save();


        return redirect()->back()->with('success', 'Documents uploaded successfully.');
    }




    public function show($id)
    {
        $application = \App\Models\MobilityApplication::findOrFail($id);

        return view('mobility.show', compact('application'));
    }

    public function showUploadForm($id)
    {
        $application = MobilityApplication::findOrFail($id);
        return view('mobility.upload_form', compact('application'));
    }



    public function handleApproval(Request $request, $id)
    {
        $app = MobilityApplication::with('proposal')->findOrFail($id);

        if ($request->input('action') === 'approve') {
            $app->admin_approval_status = 'approved';
            $app->admin_approver_name = $request->input('admin_approver_name');
            $app->admin_approval_date = $request->input('admin_approval_date');
            $app->admin_rejection_reason = null;
        } elseif ($request->input('action') === 'reject') {
            $app->admin_approval_status = 'rejected';
            $app->admin_approver_name = $request->input('admin_approver_name');
            $app->admin_approval_date = $request->input('admin_approval_date');
            $app->admin_rejection_reason = $request->input('admin_rejection_reason');
        }

        $app->save();

        // Notify student
        $app->user->notify(new MobilityApplicationDecisionNotification(
            $app,
            $app->admin_approval_status
        ));


        // Notify staff who submitted the proposal (if exists)
        if ($app->proposal && $app->proposal->submitted_by_email) {
            Notification::route('mail', $app->proposal->submitted_by_email)
            ->notify(new MobilityApplicationDecisionNotification(
                $app,
                $app->admin_approval_status
            ));
        }

        return back()->with('success', 'Decision has been recorded and notifications sent.');
    }

    public function handleRejection(Request $request, $id)
    {
        $request->validate([
            'admin_rejection_reason' => 'required|string',
        ]);

        $app = MobilityApplication::findOrFail($id);
        $app->admin_approval_status = 'rejected';
        $app->admin_rejection_reason = $request->admin_rejection_reason;
        $app->save();

        $student = $app->user;
        $staffEmails = [$app->proposal->submitted_by_email];
        $staffUsers = User::whereIn('email', (array) $staffEmails)->get();

        Notification::send([$student, ...$staffUsers], new MobilityApplicationDecisionNotification($app, 'rejected'));

        return back()->with('success', 'Application rejected and user notified.');
    }



}
