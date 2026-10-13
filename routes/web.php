<?php

use Devel\SmartCrudGenerator\Controllers\SmartCrudGeneratorController;
use Devel\SmartCrudGenerator\Controllers\PreviewController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function() {
    Route::get('/smart-crud-generator', [SmartCrudGeneratorController::class, 'index']);
    
    Route::post('/smart-crud/generate', [SmartCrudGeneratorController::class, 'generate']);

    Route::post('/smart-crud-generate/preview', [PreviewController::class,  'preview']);
});