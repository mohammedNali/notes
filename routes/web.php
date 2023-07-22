<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
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

Route::get('/posts/{slug}', function ($slug) {
    return $slug;
});

Route::post('/posts/{slug}', function ($slug) {
    return $slug;
});

//Route::get('/invokable', PdfController::class);


// notes.test/dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Create / Read / Update / Delete (CRUD)
Route::resource('notes', NoteController::class)->only(['index', 'edit', 'update', 'store', 'destroy'])->middleware(['auth']);

//Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
//Route::get('/notes/{id}/edit', [NoteController::class, 'edit'])->name('notes.edit');
//Route::post('/notes/{id}/edit', [NoteController::class, 'update'])->name('notes.update');
//Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');


Route::get('/test', [\App\Http\Controllers\TestController::class, 'index']);


//Route::get('/notes', [NoteController::class,'index']);
//Route::get('/notes/{id}', [NoteController::class,'show']);


require __DIR__.'/auth.php';
