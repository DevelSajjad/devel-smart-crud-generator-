<?php

namespace Devel\SmartCrudGenerator\Generator;

use Devel\SmartCrudGenerator\Definitions\CrudDefinition;

class ControllerGenerator
{
    public function generate(CrudDefinition $definition)
    {
        $stub = file_get_contents(
            __DIR__ . '/../../resources/stubs/controller.stub'
        );

        $validation =
            $this->generateValidation($definition);

        $content = str_replace(
            [
                '{{ model }}',
                '{{ controller }}',
                '{{ view }}',
                '{{ route }}',
                '{{ variable }}',
                '{{ validation }}',
            ],
            [
                $definition->modelName,
                $definition->controllerName,
                $definition->viewName,
                $definition->routeName,
                $definition->variableName,
                $validation,
            ],
            $stub
        );

        $directory =
            app_path('Http/Controllers');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename =
            $definition->controllerName . '.php';

        $path =
            $directory . '/' . $filename;

        if (file_exists($path)) {
            throw new \RuntimeException(
                "Controller already exists: {$path}"
            );
        }

        file_put_contents($path, $content);

        return $path;
    }

    private function generateValidation(
        CrudDefinition $definition
    ) {
        $lines = [];

        foreach ($definition->columns as $column) {
            $rules = $this->validationRules($column);

            $lines[] =
                "            '{$column->name}' => '{$rules}',";
        }

        return implode("\n", $lines);
    }

    private function validationRules($column)
    {
        $rules = [];

        if (!$column->nullable) {
            $rules[] = 'required';
        } else {
            $rules[] = 'nullable';
        }

        switch ($column->type) {
            case 'string':
                $rules[] = 'string';

                if ($column->length) {
                    $rules[] =
                        'max:' . $column->length;
                }

                break;

            case 'text':
            case 'longText':
                $rules[] = 'string';
                break;

            case 'integer':
            case 'bigInteger':
            case 'smallInteger':
            case 'tinyInteger':
            case 'unsignedInteger':
            case 'unsignedBigInteger':
                $rules[] = 'integer';
                break;

            case 'decimal':
            case 'float':
            case 'double':
                $rules[] = 'numeric';
                break;

            case 'boolean':
                $rules[] = 'boolean';
                break;

            case 'date':
            case 'dateTime':
            case 'timestamp':
                $rules[] = 'date';
                break;

            case 'time':
                $rules[] = 'date_format:H:i:s';
                break;

            case 'json':
                $rules[] = 'json';
                break;
        }

        return implode('|', $rules);
    }
}