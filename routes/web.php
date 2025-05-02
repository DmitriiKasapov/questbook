<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\SceneController;
use App\Http\Controllers\Admin\AdminStoryController;
use App\Http\Controllers\Admin\AdminSceneController;
use App\Http\Controllers\Admin\AdminBranchController;
use App\Http\Controllers\ReadStoryController;

/*
|--------------------------------------------------------------------------
| Страницы приложения (доступны всем)
|--------------------------------------------------------------------------
*/

Route::get('/', [StoryController::class, 'index']);

Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('/stories/{story}', [StoryController::class, 'show'])->name('stories.show');

// Страница чтения истории (глава + сцена)
Route::get('/story/{story}/read/{scene?}', [ReadStoryController::class, 'show'])->name('story.read');

/*
|--------------------------------------------------------------------------
| Админка (только для авторизованных админов)
|--------------------------------------------------------------------------
*/

    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        // Главная панель
        Route::get('panel', function () {
            $stories = \App\Models\Story::orderBy('id')->get();
            $scenes = \App\Models\Scene::with('story')->orderBy('id')->get();
            return view('admin.panel', compact('stories', 'scenes'));
        })->name('panel');

        // CRUD для историй и сцен
        Route::resource('stories', AdminStoryController::class)->except(['show']);
        Route::resource('scenes', AdminSceneController::class)->except(['show']);

        // Ветки
        Route::post('branches', [AdminBranchController::class, 'store'])->name('branches.store');
        Route::delete('branches/{branch}', [AdminBranchController::class, 'destroy'])->name('branches.destroy');

        // Главы
        Route::post('chapters', [\App\Http\Controllers\Admin\ChapterController::class, 'store'])->name('chapters.store');
        Route::put('chapters/{chapter}', [\App\Http\Controllers\Admin\ChapterController::class, 'update'])->name('chapters.update');
        Route::delete('chapters/{chapter}', [\App\Http\Controllers\Admin\ChapterController::class, 'destroy'])->name('chapters.destroy');
    });
    // Перенаправление /admin → /admin/panel
    Route::redirect('/admin', '/admin/panel');

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
