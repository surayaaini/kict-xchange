<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MouMoaController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;



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


//Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/admin-dashboard', [AdminPostController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/posts', [AdminPostController::class, 'history'])->name('posts.post.history');
    Route::get('/posts/{id}', [AdminPostController::class, 'show'])->name('posts.show');
    Route::patch('/posts/{id}/approve', [AdminPostController::class, 'approve'])->name('posts.approve');
    Route::patch('/posts/{id}/reject', [AdminPostController::class, 'reject'])->name('posts.reject');
    Route::get('/posts/{id}/edit', [AdminPostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [AdminPostController::class, 'update'])->name('posts.update');
//});
