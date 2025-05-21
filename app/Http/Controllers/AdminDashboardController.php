<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MobilityApplication;
use App\Models\Proposal;
use App\Models\MouMoa;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $mobilityApplicationCount = \App\Models\MobilityApplication::count();
        $proposalCount = Proposal::count();
        $moumoaCount = \App\Models\MouMoa::count();

        $latestProposals = Proposal::orderBy('created_at', 'desc')->take(5)->get(); // Get latest 5 proposals

        return view('admin.admin-dashboard', compact(
            'mobilityApplicationCount',
            'proposalCount',
            'moumoaCount',
            'latestProposals'
        ));
    }


}

