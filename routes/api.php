<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VueFinderController;

// VueFinder API Routes
Route::prefix('/files')
->middleware('throttle:100,1')
->group(function () {
    // GET routes
    Route::get('/', [VueFinderController::class, 'index'])->name('vuefinder.index');
    Route::get('/search', [VueFinderController::class, 'search'])->name('vuefinder.search');
    Route::get('/download', [VueFinderController::class, 'download'])->name('vuefinder.download');
    Route::get('/preview', [VueFinderController::class, 'preview'])->name('vuefinder.preview');

    // POST routes
    Route::post('/rename', [VueFinderController::class, 'rename'])->name('vuefinder.rename');
    Route::post('/save', [VueFinderController::class, 'save'])->name('vuefinder.save');
    Route::post('/move', [VueFinderController::class, 'move'])->name('vuefinder.move');
    Route::post('/copy', [VueFinderController::class, 'copy'])->name('vuefinder.copy');
    Route::post('/upload', [VueFinderController::class, 'upload'])->name('vuefinder.upload');
    Route::post('/archive', [VueFinderController::class, 'archive'])->name('vuefinder.archive');
    Route::post('/unarchive', [VueFinderController::class, 'unarchive'])->name('vuefinder.unarchive');
    Route::post('/create-file', [VueFinderController::class, 'createFile'])->name('vuefinder.create-file');
    Route::post('/create-folder', [VueFinderController::class, 'createFolder'])->name('vuefinder.create-folder');
    Route::post('/delete', [VueFinderController::class, 'delete'])->name('vuefinder.delete');
});
