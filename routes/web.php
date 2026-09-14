<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Process login
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register 
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class,'register']);


// Protected
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('cars', CarController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('maintenances', MaintenanceController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('fleets', FleetController::class);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


        //Admin_only 
        Route::middleware('admin')->group(function (){
        Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
        Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');


        });
});