<?php

namespace Devel\SmartCrudGenerator\Controllers;

use Illuminate\Http\Request;

class PreviewController
{
    public function index()
    {
        return view('smart-crud::preview');
    }
}