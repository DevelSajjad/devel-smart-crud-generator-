<?php

namespace Devel\SmartCrudGenerator\Controllers;

use Illuminate\Http\Request;
use Devel\SmartCrudGenerator\Definitions\CrudDefinition;
use Devel\SmartCrudGenerator\Generator\PreviewService;

class PreviewController
{
    public function index()
    {
        return view('smart-crud::preview');
    }

    public function preview(
        Request $request,
        PreviewService $previewService
    ) {
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
                'in:string,text,longText,integer,bigInteger,smallInteger,tinyInteger,unsignedInteger,unsignedBigInteger,boolean,decimal,float,double,date,dateTime,time,timestamp,json',
            ],

            'columns.*.nullable' => [
                'sometimes',
                'boolean',
            ],

            'columns.*.unique' => [
                'sometimes',
                'boolean',
            ],

            'columns.*.index' => [
                'sometimes',
                'boolean',
            ],

            'columns.*.unsigned' => [
                'sometimes',
                'boolean',
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

            'columns.*.default' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        foreach ($data['columns'] as &$column) {
            $column['nullable'] = isset($column['nullable']);
            $column['unique'] = isset($column['unique']);
            $column['index'] = isset($column['index']);
            $column['unsigned'] = isset($column['unsigned']);
        }

        unset($column);

        $definition = new CrudDefinition(
            $data['model_name'],
            $data['columns']
        );

        $previews = $previewService->preview($definition);

        return view(
            'smart-crud::preview',
            compact('previews')
        );
    }
}