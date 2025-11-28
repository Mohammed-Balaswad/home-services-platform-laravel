<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ReviewController;

Route::get('/', function () {
    return view('welcome');
});


// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Admin Section
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    // users management (resource)
    Route::resource('users', UserController::class);

    // technicians
    Route::get('/technicians', [TechnicianController::class, 'index'])
        ->name('technicians.index');

    Route::get('/technicians/{id}', [TechnicianController::class, 'show'])
        ->name('technicians.show');

    Route::get('/technicians/{id}/edit', [TechnicianController::class, 'edit'])
        ->name('technicians.edit');

    Route::put('/technicians/{id}', [TechnicianController::class, 'update'])
        ->name('technicians.update');


    // Technician Services Management
    Route::get('/technicians/{id}/services', [TechnicianController::class, 'services'])
        ->name('technicians.services');

    Route::post('/technicians/{id}/services', [TechnicianController::class, 'attachService'])
        ->name('technicians.services.attach');

    Route::delete('/technicians/{id}/services/{serviceId}', [TechnicianController::class, 'detachService'])
        ->name('technicians.services.detach');


    // Technician Schedule
    Route::get('/technicians/{id}/schedule', [TechnicianController::class, 'schedule'])
        ->name('technicians.schedule');

    Route::post('/technicians/{id}/schedule', [TechnicianController::class, 'addSchedule'])
    ->name('technicians.schedule.add');    


    // Technician Reviews
    Route::get('/technicians/{id}/reviews', [TechnicianController::class, 'reviews'])
        ->name('technicians.reviews');

    // Technician Delete
    Route::delete('/technicians/{id}', [TechnicianController::class, 'destroy'])
        ->name('technicians.destroy');

    
    // Services
    Route::resource('services', ServiceController::class);  

      
    // Categories Management
    Route::resource('categories', CategoryController::class);


    Route::resource('bookings', BookingController::class)
        ->except(['create', 'store']); 


    // Reviews Management
    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('index');
        Route::get('/{id}', [ReviewController::class, 'show'])->name('show');
        Route::delete('/{id}', [ReviewController::class, 'destroy'])->name('destroy');
    });
    
    
});






Route::middleware(['auth', 'technician'])->get('/technician/dashboard', function () {
    return view('dashboards.technician');
})->name('dashboard.tech');


Route::middleware(['auth', 'client'])->get('/client/dashboard', function () {
    return  view('dashboards.client');
})->name('dashboard.client');