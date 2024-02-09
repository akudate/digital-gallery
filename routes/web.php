<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MainController;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [MainController::class, 'index']);

// Auth
Route::get('/login', [AuthController::class, 'loginpage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'registerpage'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Placeholder
// Route::group(['middleware' => ['auth', 'checkrole:admin']], function () {
//     // Dashboard
//     Route::get('/dashboard', function () {
//         return view('layout');
//     });

//     // Foto
//     Route::get('/galeri', [FotoController::class, 'index']);
//     Route::post('/add-foto', [FotoController::class, 'store']);
//     Route::post('/edit-foto', [FotoController::class, 'update']);
//     Route::post('/delete-foto', [FotoController::class, 'delete']);

// });

Route::group(['middleware' => ['auth']], function () {
    // Public
    Route::get('/upload', function () {
        $album = Album::where('userid', Auth::id())->get();
        return view('main.upload', compact('album'));
    });
    Route::get('/view-foto/{id}', [MainController::class, 'viewfoto']);
    Route::post('/add-foto-user', [MainController::class, 'storefoto']);
    Route::post('/edit-foto-user', [MainController::class, 'editfoto']);
    Route::post('/delete-foto-user', [MainController::class, 'deletefoto']);
    Route::post('/komentar', [MainController::class, 'komentar']);
    Route::post('/like/{id}', [MainController::class, 'like'])->name('like.toggle');

    // Personal
    Route::get('/myfoto', [MainController::class, 'myfoto']);
    Route::get('/myalbum', [MainController::class, 'myalbum']);
    Route::get('/view-album/{id}', [MainController::class, 'viewalbum']);
    Route::post('/add-album-user', [MainController::class, 'storealbum']);
    Route::post('/edit-album-user', [MainController::class, 'editalbum']);
    Route::post('/delete-album-user', [MainController::class, 'deletealbum']);
});
