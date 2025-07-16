<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PictureController;
use Illuminate\Support\Facades\Route;

/* Page d'accueil */
Route::get('/', [HomeController::class, 'index'])->name("home");


/* Authentification */
Route::get("/login", [AuthController::class, 'showLogin'])->name("login");
Route::post("/login", [AuthController::class, "loginAction"])->name("login_action");

Route::get("/register", [AuthController::class, 'showRegister'])->name("register");
Route::post("/register", [AuthController::class, 'registerAction'])->name("register_action");

Route::get("/auth/check", [AuthController::class, 'checkUser'])->name("check");
Route::post("/logout", [AuthController::class, "logout"])->name("logout");


/* Les photos */
Route::get('/photos', [PictureController::class, 'index']);
Route::get("/ajouter-photo", [PictureController::class, 'showAddPicture'])->middleware(['auth', 'verified'])->name('photo.create');
Route::post("/ajouter-photos", [PictureController::class, 'addPicture'])->middleware(['auth', 'verified'])->name('photo.create.action');

// Routes protégées pour les likes
Route::middleware(['auth'])->group(function () {
    Route::post('/photos/{picture}/like', [PictureController::class, 'like']);
    Route::post('/photos/{picture}/unlike', [PictureController::class, 'unlike']);
    Route::get('/user/likes', [PictureController::class, 'userLikes']);
});

// Administration
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::delete('/pictures/{picture}', [AdminController::class, 'deletePicture'])->name('pictures.delete');
    Route::post('/pictures/bulk-delete', [AdminController::class, 'bulkDelete'])->name('bulk-delete');
});