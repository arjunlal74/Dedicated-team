<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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
    return view('frontend.index');
});

Route::get('/admin/contact-list',[ContactController::class,'index'])->name('admin.contact-list')->middleware(['auth', 'verified']);
Route::delete('admin/contact/{id}/delete',[ContactController::class,'destroy'])->name('admin.contact.delete')->middleware(['auth', 'verified']);
Route::post('admin/send-reply',[ContactController::class,'sendReply'])->name('send-reply')->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('contact-save',[ContactController::class , 'store'])->name('contact.store');

require __DIR__.'/auth.php';
