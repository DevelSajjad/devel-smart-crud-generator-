<?php

namespace Devel\SmartCrudGenerator\Generator;

use Devel\SmartCrudGenerator\Definitions\CrudDefinition;

class ModelGenerator
{
    public function generate(CrudDefinition $definition)
    {
        $stub = file_get_contents(
            __DIR__ . '/../../resources/stubs/model.stub'
        );

        $fillable = $this->generateFillable($definition);

        $content = str_replace(
            [
                '{{ model }}',
                '{{ fillable }}',
            ],
            [
                $definition->modelName,
                $fillable,
            ],
            $stub
        );

        $directory = app_path('Models');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename =
            $definition->modelName . '.php';

        $path = $directory . '/' . $filename;

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