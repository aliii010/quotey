<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RFQController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    if ($request->user() && $request->user()->hasRole('admin')) {
        return redirect()->route('users.index');
    }

    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
        // Role routes
        Route::resource('roles', RoleController::class)->except('show');
        Route::get('/roles/{roleId}/permissions', [RoleController::class, 'showAssignPermissionForm'])->name('roles.permissions');
        Route::post('/roles/{roleId}/assign-permission/{permissionId}', [RoleController::class, 'assignPermission'])->name('roles.assign-permission');
        Route::post('/roles/{roleId}/revoke-permission/{permissionId}', [RoleController::class, 'removePermission'])->name('roles.revoke-permission');

        // Permission routes
        Route::resource('permissions', PermissionController::class)->except('show', 'index');

        // User routes
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{userId}/roles', [UserController::class, 'showUserRoles'])->name('users.showUserRoles');
        Route::put('/users/{userId}/roles', [UserController::class, 'updateRoles'])->name('users.updateRoles');
    });

    Route::get('/rfq', \App\Livewire\Rfq\Index::class)->name('rfq.index')->middleware('permission:view_rfq');
    Route::get('/rfq/{id}', \App\Livewire\Rfq\Detail::class)->name('rfq.detail')->middleware('permission:view_rfq');
});


Route::get('/rfq/step1', \App\Livewire\Rfq\Step1::class)->name('rfq.step1');
Route::get('/rfq/step2', \App\Livewire\Rfq\Step2::class)->name('rfq.step2');
Route::get('/counter', Counter::class);

require __DIR__.'/auth.php';
