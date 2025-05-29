<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MobilityApplication;
use App\Models\Proposal;
use App\Models\MouMoa;
use App\Models\InboundStudent;
use App\Models\Post;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $mobilityApplicationCount = \App\Models\MobilityApplication::count();
        $proposalCount = Proposal::count();
        $moumoaCount = \App\Models\MouMoa::count();
        $inboundStudentCount = InboundStudent::count();
        $posts = Post::where('status', 'pending')->latest()->get();



        $latestProposals = Proposal::orderBy('created_at', 'desc')->take(5)->get(); // Get latest 5 proposals

        return view('admin.admin-dashboard', compact(
            'mobilityApplicationCount',
            'proposalCount',
            'moumoaCount',
            'latestProposals',
            'inboundStudentCount',
            'posts'
        ));
    }


}

