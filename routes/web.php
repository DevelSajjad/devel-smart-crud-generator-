<?php

use Devel\SmartCrudGenerator\Controllers\SmartCrudGeneratorController;
use Illuminate\Support\Facades\Route;

Route::get('/smart-crud-generator', [SmartCrudGeneratorController::class, 'index']);

Route::post('/smart-crud/generate', [SmartCrudGeneratorController::class, 'generate']);