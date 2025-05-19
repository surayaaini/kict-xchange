<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MouMoaController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\AdminProposalController;
use App\Http\Controllers\MobilityApplicationController;
use App\Http\Controllers\InboundStudentController;
use App\Http\Middleware\RoleMiddleware;



Route::get('/mou-moa', [MouMoaController::class, 'index'])->name('moumoa.index');

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mou-moa', [MouMoaController::class, 'index'])->name('moumoa.index'); // View list (all users)
});
// Route::middleware(['auth', 'role:admin'])->group(function () {

Route::middleware(['auth'])->group(function () {
    Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('faqs', FaqController::class);
    Route::get('/admin/faqs', [FaqController::class, 'admin'])->name('faq.admin');
});

Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');



Route::middleware(['auth'])->group(function () {
    Route::get('/mou-moa/create', [MouMoaController::class, 'create'])->name('moumoa.create');
    Route::post('/mou-moa', [MouMoaController::class, 'store'])->name('moumoa.store');
    Route::get('/mou-moa/{id}/edit', [MouMoaController::class, 'edit'])->name('moumoa.edit');
    Route::put('/mou-moa/{id}', [MouMoaController::class, 'update'])->name('moumoa.update');
    Route::delete('/mou-moa/{id}', [MouMoaController::class, 'destroy'])->name('moumoa.destroy');
    Route::delete('/moumoa/{id}', [MouMoaController::class, 'destroy'])->name('moumoa.destroy');

});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Set welcome-dashboard as the main dashboard
    Route::get('/dashboard', function () {
        return view('admin/welcome-dashboard');
    })->name('dashboard');

    // Route for admin dashboard
    //Route::get('admin-dashboard', function () {
     //   return view('admin/admin-dashboard');
    //})->name('admin.dashboard');

    // Route for teacher dashboard
    Route::get('teacher-dashboard', function () {
        return view('admin/teacher-dashboard');
    })->name('teacher.dashboard');

    // Route for student dashboard
    Route::get('student-dashboard', function () {
        return view('admin/student-dashboard');
    })->name('student.dashboard');

    Route::get('/about', function () {
        return view('student.about');
    })->name('about');


});

Route::get('/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/submit', [PostController::class, 'store'])->name('posts.store');
Route::get('/index', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/full/{id}', [PostController::class, 'fullpost'])->name('posts.full.post');
Route::get('/student-dashboard', [PostController::class, 'studentdashboard'])->name('student.dashboard');


Route::get('/admin-dashboard', [AdminPostController::class, 'admindashboard'])->name('admin.dashboard');
Route::get('/posts', [AdminPostController::class, 'history'])->name('posts.post.history');
Route::get('/posts/{id}', [AdminPostController::class, 'show'])->name('posts.show');
Route::patch('/posts/{id}/approve', [AdminPostController::class, 'approve'])->name('posts.approve');
Route::patch('/posts/{id}/reject', [AdminPostController::class, 'reject'])->name('posts.reject');
Route::get('/posts/{id}/edit', [AdminPostController::class, 'edit'])->name('posts.edit');
Route::match(['put', 'patch'],'/posts/{id}', [AdminPostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [AdminPostController::class, 'destroy'])->name('posts.destroy');


Route::middleware(['auth'])->group(function () {
    Route::get('/proposal/create', [ProposalController::class, 'create'])->name('proposal.create');
    Route::post('/proposal/store', [ProposalController::class, 'store'])->name('proposal.store');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('proposal', \App\Http\Controllers\ProposalController::class);
});

Route::get('/proposal/{id}', [ProposalController::class, 'show'])->name('proposal.show');
Route::get('/proposal', [ProposalController::class, 'index'])->name('proposal.index');
Route::post('/proposal', [ProposalController::class, 'store'])->name('proposal.store');
Route::delete('/proposal/{id}', [ProposalController::class, 'destroy'])->name('proposal.destroy');
Route::get('/proposal/{id}/edit', [ProposalController::class, 'edit'])->name('proposal.edit');
Route::put('/proposal/{id}', [ProposalController::class, 'update'])->name('proposal.update');

// Admin Proposal Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/proposals', [App\Http\Controllers\AdminProposalController::class, 'index'])->name('admin.proposals.index');
    Route::get('/admin/proposals/{id}/approve', [App\Http\Controllers\AdminProposalController::class, 'approve'])->name('admin.proposal.approve');
    Route::get('/admin/proposals/{id}/reject', [App\Http\Controllers\AdminProposalController::class, 'reject'])->name('admin.proposal.reject');
    Route::get('/admin/proposals/{id}', [AdminProposalController::class, 'show'])->name('admin.proposals.show');
    Route::post('/admin/proposals/{id}/approve', [AdminProposalController::class, 'approve'])->name('admin.proposals.approve');
    Route::post('/admin/proposals/{id}/reject', [AdminProposalController::class, 'reject'])->name('admin.proposals.reject');
});

Route::post('/notifications/mark-as-read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.markAsRead');

// Routes for Students to Apply
Route::middleware(['auth', 'role:3'])->group(function () {
    // Show the form (we'll split into steps later)
    Route::get('/mobility-application/{proposal}', [MobilityApplicationController::class, 'create'])
        ->name('mobility.create');

    // Store form submission
    Route::post('/mobility-application', [MobilityApplicationController::class, 'store'])
        ->name('mobility.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mobility/apply', [MobilityApplicationController::class, 'create'])->name('mobility.create');
    Route::post('/mobility/submit', [MobilityApplicationController::class, 'store'])->name('mobility.store');
});

Route::get('/mobility/apply/{proposal_id}', [MobilityApplicationController::class, 'create'])->name('mobility.create');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mobility', [MobilityApplicationController::class, 'index'])->name('mobility.index');
    Route::get('/mobility/create/{proposal_id}', [MobilityApplicationController::class, 'create'])->name('mobility.create');
    Route::post('/mobility/store', [MobilityApplicationController::class, 'store'])->name('mobility.store');
});

Route::get('mobility/{id}/upload-documents', [MobilityApplicationController::class, 'showUploadForm'])->name('mobility.upload_form');
Route::post('mobility/{id}/upload-documents', [MobilityApplicationController::class, 'uploadDocuments'])->name('mobility.upload_documents');

Route::get('/mobility/upload-documents/{id}', [MobilityApplicationController::class, 'showUploadForm'])->name('mobility.showUploadForm');
Route::post('/mobility/upload-documents', [App\Http\Controllers\MobilityApplicationController::class, 'uploadDocuments'])->name('mobility.uploadDocuments');
Route::post('/mobility/upload-documents', [MobilityApplicationController::class, 'uploadDocuments'])->name('mobility.upload_documents');

Route::get('/mobility/{id}', [MobilityApplicationController::class, 'show'])->name('mobility.show');
Route::get('/mobility/upload-form/{id}', [MobilityApplicationController::class, 'showUploadForm'])->name('mobility.upload_form');

Route::post('/mobility/{id}/approval', [MobilityApplicationController::class, 'handleApproval'])
    ->name('mobility.handleApproval');
    // ->middleware(['auth', 'role:admin']);

Route::get('/inbound_student', [InboundStudentController::class, 'index'])->name('inbounds.index');
Route::get('/inbound_student/create', [InboundStudentController::class, 'create'])->name('inbounds.create');
Route::post('/inbound_student', [InboundStudentController::class, 'store'])->name('inbounds.store');
Route::delete('/inbound_student/{id}', [InboundStudentController::class, 'destroy'])->name('inbounds.destroy');
Route::get('/inbound/import', [InboundStudentController::class, 'showImportForm'])->name('inbounds.import.form');
Route::post('/inbound/import', [InboundStudentController::class, 'importExcel'])->name('inbounds.import');
Route::get('/admin-dashboard', [InboundStudentController::class, 'dashboard'])->name('admin.dashboard');