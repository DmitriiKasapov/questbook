<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\SceneController;
use App\Http\Controllers\Admin\AdminStoryController;
use App\Http\Controllers\Admin\AdminSceneController;

/*
|--------------------------------------------------------------------------
| Страницы приложения (доступны всем)
|--------------------------------------------------------------------------
*/

Route::get('/', [StoryController::class, 'index']);

Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('/stories/{story}', [StoryController::class, 'show'])->name('stories.show');
Route::get('/scenes/{scene}', [SceneController::class, 'show'])->name('scenes.show');

/*
|--------------------------------------------------------------------------
| Админка (только для авторизованных админов)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('stories', AdminStoryController::class)->except(['show']);
    Route::resource('scenes', AdminSceneController::class)->except(['show']);
    Route::get('panel', function () {
        $stories = \App\Models\Story::orderBy('id')->get();
        $scenes = \App\Models\Scene::with('story')->orderBy('id')->get();
        return view('admin.panel', compact('stories', 'scenes'));
    })->name('panel');
});

/*
|--------------------------------------------------------------------------
| Профиль (от Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // можно убрать, если не нужен
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
