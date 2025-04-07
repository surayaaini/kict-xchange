<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MouMoaController;
use App\Http\Controllers\FaqController;


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

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('faqs', FaqController::class);
    Route::get('/admin/faqs', [FaqController::class, 'admin'])->name('faq.admin')->middleware('auth');

});


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
    Route::get('admin-dashboard', function () {
        return view('admin/admin-dashboard');
    })->name('admin.dashboard');

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


