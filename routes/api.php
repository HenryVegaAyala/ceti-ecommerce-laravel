<?php

use App\Http\Controllers\Api\Category\CategoryController;

Route::group(['prefix' => 'v1'], function () {

    Route::get('categories', [CategoryController::class, 'index'])->name('api.categories.index');
    Route::post('categories', [CategoryController::class, 'store'])->name('api.categories.store');
    Route::get('categories/{id}', [CategoryController::class, 'show'])->name('api.categories.show');
    Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('api.categories.destroy');
    Route::put('categories/{id}', [CategoryController::class, 'update'])->name('api.categories.update');
});
