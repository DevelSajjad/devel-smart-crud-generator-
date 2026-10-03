<?php

use Devel\SmartCrudGenerator\Controllers\SmartCrudGeneratorController;
use Illuminate\Support\Facades\Route;

Route::get('/smart-crud-generator', [SmartCrudGeneratorController::class, 'index']);