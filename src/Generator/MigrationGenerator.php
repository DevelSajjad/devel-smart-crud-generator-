<?php

namespace Devel\SmartCrudGenerator\Generator;

use Devel\SmartCrudGenerator\Definitions\CrudDefinition;
use Devel\SmartCrudGenerator\Definitions\ColumnDefinition;

class MigrationGenerator
{
    public function generate(CrudDefinition $definition)
    {
        $columns = $this->generateColumns($definition);

        $stub = $this->getStub();

        $className = 'Create' .
            ucfirst($definition->tableName) .
            'Table';

        $content = str_replace(
            [
                '{{ class }}',
                '{{ table }}',
                '{{ columns }}',
            ],
            [
                $className,
                $definition->tableName,
                $columns,
            ],
            $stub
        );

        $directory = database_path('migrations');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename =
            date('Y_m_d_His') .
            '_create_' .
            $definition->tableName .
            '_table.php';

        $path = $directory . '/' . $filename;

        file_put_contents($path, $content);

        return $path;
    }

    private function getStub()
    {
        $version = app()->version();

        $majorVersion = (int) explode('.', $version)[0];

        if ($majorVersion >= 8) {
            return file_get_contents(
                __DIR__ .
                '/../../resources/stubs/migration.anonymous.stub'
            );
        }

        return file_get_contents(
            __DIR__ .
            '/../../resources/stubs/migration.class.stub'
        );
    }

    private function generateColumns(CrudDefinition $definition)
    {
        $lines = [];

        $lines[] = "\$table->bigIncrements('id');";

        foreach ($definition->columns as $column) {
            $lines[] = $this->generateColumn($column);
        }

        $lines[] = "            \$table->timestamps();";

        return implode("\n", $lines);
    }

    private function generateColumn(ColumnDefinition $column)
    {
        $method = $this->columnMethod($column);

        $line = "            \$table->{$method}";

        $line .= $this->columnArguments($column);

        $line .= $this->columnModifiers($column);

        return $line . ';';
    }

    private function columnMethod(ColumnDefinition $column)
    {
        switch ($column->type) {
            case 'string':
                return 'string';

            case 'text':
                return 'text';

            case 'longText':
                return 'longText';

            case 'integer':
                return 'integer';

            case 'bigInteger':
                return 'bigInteger';

            case 'smallInteger':
                return 'smallInteger';

            case 'tinyInteger':
                return 'tinyInteger';

            case 'unsignedInteger':
                return 'unsignedInteger';

            case 'unsignedBigInteger':
                return 'unsignedBigInteger';

            case 'boolean':
                return 'boolean';

            case 'decimal':
                return 'decimal';

            case 'float':
                return 'float';

            case 'double':
                return 'double';

            case 'date':
                return 'date';

            case 'dateTime':
                return 'dateTime';

            case 'time':
                return 'time';

            case 'timestamp':
                return 'timestamp';

            case 'json':
                return 'json';

            default:
                throw new \InvalidArgumentException(
                    "Unsupported column type: {$column->type}"
                );
        }
    }

    private function columnArguments(ColumnDefinition $column)
    {
        switch ($column->type) {
            case 'string':
                $length = $column->length ?: 255;

                return "('{$column->name}', {$length})";

            case 'decimal':
                $precision = $column->precision ?: 10;
                $scale = $column->scale ?: 2;

                return "('{$column->name}', {$precision}, {$scale})";

            default:
                return "('{$column->name}')";
        }
    }

    private function columnModifiers(ColumnDefinition $column)
    {
        $modifiers = '';

        if (
            $column->unsigned &&
            !in_array($column->type, [
                'unsignedInteger',
                'unsignedBigInteger',
            ])
        ) {
            $modifiers .= '->unsigned()';
        }

        if ($column->nullable) {
            $modifiers .= '->nullable()';
        }

        if ($column->unique) {
            $modifiers .= '->unique()';
        }

        if ($column->index) {
            $modifiers .= '->index()';
        }

        if ($column->default !== null && $column->default !== '') {
            $modifiers .= '->default(' .
                $this->formatDefault($column->default) .
                ')';
        }

        return $modifiers;
    }

    private function formatDefault($value)
    {
        if (is_numeric($value)) {
            return $value;
        }

        if ($value === 'true') {
            return 'true';
        }

        if ($value === 'false') {
            return 'false';
        }

        if ($value === 'null') {
            return 'null';
        }

        return "'" . addslashes($value) . "'";
    }
}