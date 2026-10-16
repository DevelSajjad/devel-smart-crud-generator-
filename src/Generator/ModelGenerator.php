<?php

namespace Devel\SmartCrudGenerator\Generator;
use Devel\SmartCrudGenerator\Support\LaravelCompatibility;

use Devel\SmartCrudGenerator\Definitions\CrudDefinition;

class ModelGenerator
{
    public function getPath(CrudDefinition $definition)
    {
        // return app_path(
        //     'Models/' .
        //     $definition->modelName .
        //     '.php'
        // );
        $compatibility = new LaravelCompatibility();

        return $compatibility->modelPath(
            $definition->modelName
        );
    }

    public function buildContent(CrudDefinition $definition) {
        $stub = file_get_contents(
            __DIR__ . '/../../resources/stubs/model.stub'
        );

        $compatibility = new LaravelCompatibility();

        $fillable = $this->generateFillable($definition);

        return str_replace(
            [
                '{{ model_namespace }}',
                '{{ model }}',
                '{{ fillable }}',
            ],
            [
                $compatibility->modelNamespace(),
                $definition->modelName,
                $fillable,
            ],
            $stub
        );
    }

    public function generate(CrudDefinition $definition)
    {
        $stub = file_get_contents(
            __DIR__ . '/../../resources/stubs/model.stub'
        );

        $compatibility = new LaravelCompatibility();

        $fillable = $this->generateFillable($definition);

        $content = $this->buildContent($definition);

        $path = $this->getPath($definition);

        $directory = dirname($path);

        // $directory = app_path('Models');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // $filename =
        //     $definition->modelName . '.php';

        // $path = $directory . '/' . $filename;

        if (file_exists($path)) {
            throw new \RuntimeException(
                "Model already exists: {$path}"
            );
        }

        file_put_contents($path, $content);

        return $path;
    }

    private function generateFillable(CrudDefinition $definition)
    {
        $lines = [];

        foreach ($definition->columns as $column) {
            $lines[] = "        '{$column->name}',";
        }

        return implode("\n", $lines);
    }
}