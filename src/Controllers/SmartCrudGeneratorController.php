<?php

namespace Devel\SmartCrudGenerator\Controllers;

use Illuminate\Http\Request;
use Devel\SmartCrudGenerator\Definitions\CrudDefinition;
use Devel\SmartCrudGenerator\Generator\MigrationGenerator;
use Devel\SmartCrudGenerator\Generator\ModelGenerator;
use Devel\SmartCrudGenerator\Generator\ControllerGenerator;
use Devel\SmartCrudGenerator\Generator\RouteGenerator;
use Devel\SmartCrudGenerator\Generator\ViewGenerator;

class SmartCrudGeneratorController
{
    public function index()
    {
        return view('smart-crud::generator');
    }

    public function generate(Request $request)
    {
        $data = $request->validate([
            'model_name' => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Z][A-Za-z0-9]*$/',
            ],

            'columns' => [
                'required',
                'array',
                'min:1',
                'max:100',
            ],

            'columns.*.name' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z_][a-zA-Z0-9_]*$/',
            ],

            'columns.*.type' => [
                'required',
                'string',
                'in:string,text,longText,integer,bigInteger,smallInteger,tinyInteger,unsignedInteger,unsignedBigInteger,boolean,decimal,float,double,date,dateTime,time,timestamp,json',
            ],

            'columns.*.nullable' => [
                'nullable',
                'boolean',
            ],

            'columns.*.unique' => [
                'nullable',
                'boolean',
            ],

            'columns.*.index' => [
                'nullable',
                'boolean',
            ],

            'columns.*.unsigned' => [
                'nullable',
                'boolean',
            ],

            'columns.*.default' => [
                'nullable',
                'string',
                'max:255',
            ],

            'columns.*.length' => [
                'nullable',
                'integer',
                'min:1',
                'max:65535',
            ],

            'columns.*.precision' => [
                'nullable',
                'integer',
                'min:1',
                'max:65',
            ],

            'columns.*.scale' => [
                'nullable',
                'integer',
                'min:0',
                'max:30',
            ],
        ]);

        foreach ($data['columns'] as &$column) {

            $column['nullable'] = isset($column['nullable']);

            $column['unique'] = isset($column['unique']);

            $column['index'] = isset($column['index']);

            $column['unsigned'] = isset($column['unsigned']);
        }

        $definition = new CrudDefinition(
            $data['model_name'],
            $data['columns']
        );

        $generator = new ViewGenerator();

        $path = $generator->generate($definition);

        dd($path);
    }
}