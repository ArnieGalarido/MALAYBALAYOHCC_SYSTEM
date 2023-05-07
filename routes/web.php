<?php

use App\Http\Controllers\CallController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\PhysicianController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/login', [UserController::class, 'login'])->name('login');

Route::post('/authenticate', [UserController::class, 'authenticate'])->name('authenticate');
Route::get('/authenticate', function () {
    return redirect(route('login'));
});
Route::middleware([
    'auth'
])->group(function () {

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/register', [UserController::class, 'register'])->name('register');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/account/{code}', [UserController::class, 'show'])->name('show');
        Route::put('/update/{code}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/{code}', [UserController::class, 'destroy'])->name('delete');
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'profile'])->name('profile');
        Route::get('/edit', [UserController::class, 'edit_profile'])->name('edit_profile');
        Route::put('/update', [UserController::class, 'update_profile'])->name('update_profile');
    });

    Route::prefix('referral-form')->name('referral-form.')->group(function () {
        Route::get('/', [ReferralController::class, 'index'])->name('index');
        Route::get('/create', [ReferralController::class, 'create'])->name('create');
        Route::post('/store', [ReferralController::class, 'store'])->name('store');
        Route::get('/{code}', [ReferralController::class, 'show'])->name('show');
        Route::get('/{code}/edit', [ReferralController::class, 'edit'])->name('edit');
        Route::put('/{code}/update', [ReferralController::class, 'update'])->name('update');
        Route::delete('/{code}/delete', [ReferralController::class, 'destroy'])->name('delete');
    });

    Route::prefix('bed-tracker')->name('bed-tracker.')->group(function () {
        Route::get('/hospital', [HospitalController::class, 'index'])->name('index');
        Route::get('/hospital/create', [HospitalController::class, 'create'])->name('add-hospital');
        Route::post('/hospital', [HospitalController::class, 'store'])->name('store');
        Route::get('/hospital/{code}/edit', [HospitalController::class, 'edit'])->name('edit');
        Route::put('/hospital/{code}/update', [HospitalController::class, 'update'])->name('update');
        Route::get('/hospital/{code}', [HospitalController::class, 'show'])->name('show');
        Route::delete('/hospital/{code}/delete', [HospitalController::class, 'destroy'])->name('delete');

        Route::prefix('hospital/{code}')->name('room.')->group(function () {
            Route::post('/room', [RoomController::class, 'store'])->name('store');
            Route::get('/room/{id}/edit', [RoomController::class, 'edit'])->name('edit');
            Route::put('/room/{id}/update', [RoomController::class, 'update'])->name('update');
            Route::delete('/room/{id}/delete', [RoomController::class, 'destroy'])->name('delete');
        });

        Route::prefix('hospital/{code}')->name('physician.')->group(function () {
            Route::post('/physician', [PhysicianController::class, 'store'])->name('store');
            Route::get('/physician/{id}/edit', [PhysicianController::class, 'edit'])->name('edit');
            Route::put('/physician/{id}/update', [PhysicianController::class, 'update'])->name('update');
            Route::delete('/physician/{id}/delete', [PhysicianController::class, 'destroy'])->name('delete');
        });
    });

    Route::prefix('calls')->name('calls.')->group(function () {
        Route::get('/', [CallController::class, 'index'])->name('index');
        Route::post('/', [CallController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CallController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [CallController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [CallController::class, 'destroy'])->name('delete');
    });

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/download', [ReportController::class, 'generatePDF'])->name('download');
    });

    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'notifications']);
        Route::get('/read/{id}', [NotificationController::class, 'read']);
    });
});

