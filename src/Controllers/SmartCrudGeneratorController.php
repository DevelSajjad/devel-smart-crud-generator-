<?php

namespace Devel\SmartCrudGenerator\Controllers;

use Illuminate\Http\Request;

class SmartCrudGeneratorController
{
    public function index()
    {
        return view('smart-crud::generator');
    }

    public function generate(Request $request)
    {
        $data = $request->all();

        dd($data);
    }
}