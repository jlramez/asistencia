<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route Hooks - Do not delete//
	Route::view('timetables', 'livewire.timetables.index')->middleware('auth');
	Route::view('types', 'livewire.types.index')->middleware('auth');
	Route::view('checks', 'livewire.checks.index')->middleware('auth');
	Route::view('usershifts', 'livewire.usershifts.index')->middleware('auth');
	Route::view('schedules', 'livewire.schedules.index')->middleware('auth');
	Route::view('employees', 'livewire.employees.index')->middleware('auth');
	Route::view('sservices', 'livewire.sservices.index')->middleware('auth');
	Route::view('reports', 'livewire.reports.reports')->middleware('auth');