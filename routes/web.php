<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

// Guest routes
Route::get('login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Profile routes (all users)
    Route::get('profile/change-password', [ProfileController::class, 'changePasswordForm'])->name('profile.change-password');
    Route::post('profile/change-password', [ProfileController::class, 'changePassword']);
    
    // Subject routes (admin & staff can modify)
    Route::get('subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('subjects/create', [SubjectController::class, 'create'])->name('subjects.create')->middleware('can_edit_content');
    Route::post('subjects', [SubjectController::class, 'store'])->name('subjects.store')->middleware('can_edit_content');
    Route::get('subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit')->middleware('can_edit_content');
    Route::put('subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update')->middleware('can_edit_content');
    Route::delete('subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy')->middleware('can_edit_content');
    
    // Program routes (admin & staff can modify)
    Route::get('programs', [ProgramController::class, 'index'])->name('programs.index');
    Route::get('programs/create', [ProgramController::class, 'create'])->name('programs.create')->middleware('can_edit_content');
    Route::post('programs', [ProgramController::class, 'store'])->name('programs.store')->middleware('can_edit_content');
    Route::get('programs/{program}/edit', [ProgramController::class, 'edit'])->name('programs.edit')->middleware('can_edit_content');
    Route::put('programs/{program}', [ProgramController::class, 'update'])->name('programs.update')->middleware('can_edit_content');
    Route::delete('programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy')->middleware('can_edit_content');
    
    // User routes (admin only)
    Route::resource('users', UserController::class)->middleware('admin');
});

// Fallback
Route::redirect('/', '/dashboard');
