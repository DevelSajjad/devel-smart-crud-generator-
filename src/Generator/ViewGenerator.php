<?php

namespace Devel\SmartCrudGenerator\Generator;

use Devel\SmartCrudGenerator\Definitions\CrudDefinition;

class ViewGenerator
{
    public function generate(CrudDefinition $definition)
    {
        $directory = resource_path(
            'views/' . $definition->viewName
        );

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $this->generateView(
            'index',
            $definition,
            $directory
        );

        $this->generateView(
            'create',
            $definition,
            $directory
        );

        $this->generateView(
            'edit',
            $definition,
            $directory
        );

        $this->generateView(
            'show',
            $definition,
            $directory
        );

        return $directory;
    }

    private function generateView(
        $view,
        CrudDefinition $definition,
        $directory
    ) {
        $stub = file_get_contents(
            __DIR__ .
            '/../../resources/stubs/views/' .
            $view .
            '.blade.stub'
        );

        $fields = $this->generateFields(
            $definition
        );

        $headers = $this->generateHeaders(
            $definition
        );

        $rows = $this->generateRows(
            $definition
        );

        $showRows = $this->generateShowRows(
            $definition
        );

        $content = str_replace(
            [
                '{{ model }}',
                '{{ variable }}',
                '{{ route }}',
                '{{ fields }}',
                '{{ headers }}',
                '{{ rows }}',
                '{{ colspan }}',
            ],
            [
                $definition->modelName,
                $definition->variableName,
                $definition->routeName,
                $fields,
                $headers,
                $view === 'show'
                    ? $showRows
                    : $rows,
                count($definition->columns) + 1,
            ],
            $stub
        );

        $path =
            $directory .
            '/' .
            $view .
            '.blade.php';

        if (file_exists($path)) {
            throw new \RuntimeException(
                "View already exists: {$path}"
            );
        }

        file_put_contents(
            $path,
            $content
        );
    }

    private function generateFields(
        CrudDefinition $definition
    ) {
        $fields = [];

        foreach ($definition->columns as $column) {
            $fields[] = $this->generateField(
                $column,
                $definition
            );
        }

        return implode("\n\n", $fields);
    }

    private function generateField(
        $column,
        CrudDefinition $definition
    ) {
        switch ($column->type) {
            case 'text':
            case 'longText':
                return $this->textareaField(
                    $column,
                    $definition
                );

            case 'boolean':
                return $this->booleanField(
                    $column,
                    $definition
                );

            case 'date':
                return $this->dateField(
                    $column,
                    $definition
                );

            case 'dateTime':
                return $this->dateTimeField(
                    $column,
                    $definition
                );

            case 'time':
                return $this->timeField(
                    $column,
                    $definition
                );

            case 'integer':
            case 'bigInteger':
            case 'smallInteger':
            case 'tinyInteger':
            case 'unsignedInteger':
            case 'unsignedBigInteger':
            case 'decimal':
            case 'float':
            case 'double':
                return $this->numberField(
                    $column,
                    $definition
                );

            default:
                return $this->textField(
                    $column,
                    $definition
                );
        }
    }

    private function textField(
        $column,
        CrudDefinition $definition
    ) {
        $variable = $definition->variableName;

        return <<<HTML
                <div class="mb-3">

                    <label class="form-label">
                        {$this->label($column->name)}
                    </label>

                    <input
                        type="text"
                        name="{$column->name}"
                        value="{{ old('{$column->name}', \${$variable}->{$column->name} ?? '') }}"
                        class="form-control @error('{$column->name}') is-invalid @enderror"
                    >

                    @error('{$column->name}')
                        <div class="invalid-feedback">
                            {{ \$message }}
                        </div>
                    @enderror

                </div>
        HTML;
    }

    private function textareaField(
        $column,
        CrudDefinition $definition
    ) {
        $variable = $definition->variableName;

        return <<<HTML
                <div class="mb-3">

                    <label class="form-label">
                        {$this->label($column->name)}
                    </label>

                    <textarea
                        name="{$column->name}"
                        class="form-control @error('{$column->name}') is-invalid @enderror"
                    >{{ old('{$column->name}', \${$variable}->{$column->name} ?? '') }}</textarea>

                    @error('{$column->name}')
                        <div class="invalid-feedback">
                            {{ \$message }}
                        </div>
                    @enderror

                </div>
        HTML;
    }

    private function numberField(
        $column,
        CrudDefinition $definition
    ) {
        $variable = $definition->variableName;

        return <<<HTML
                <div class="mb-3">

                    <label class="form-label">
                        {$this->label($column->name)}
                    </label>

                    <input
                        type="number"
                        name="{$column->name}"
                        value="{{ old('{$column->name}', \${$variable}->{$column->name} ?? '') }}"
                        class="form-control @error('{$column->name}') is-invalid @enderror"
                    >

                    @error('{$column->name}')
                        <div class="invalid-feedback">
                            {{ \$message }}
                        </div>
                    @enderror

                </div>
        HTML;
    }

    private function dateField(
        $column,
        CrudDefinition $definition
    ) {
        return $this->simpleInputField(
            $column,
            $definition,
            'date'
        );
    }

    private function dateTimeField(
        $column,
        CrudDefinition $definition
    ) {
        return $this->simpleInputField(
            $column,
            $definition,
            'datetime-local'
        );
    }

    private function timeField(
        $column,
        CrudDefinition $definition
    ) {
        return $this->simpleInputField(
            $column,
            $definition,
            'time'
        );
    }

    private function simpleInputField(
        $column,
        CrudDefinition $definition,
        $type
    ) {
        $variable = $definition->variableName;

        return <<<HTML
                <div class="mb-3">

                    <label class="form-label">
                        {$this->label($column->name)}
                    </label>

                    <input
                        type="{$type}"
                        name="{$column->name}"
                        value="{{ old('{$column->name}', \${$variable}->{$column->name} ?? '') }}"
                        class="form-control @error('{$column->name}') is-invalid @enderror"
                    >

                    @error('{$column->name}')
                        <div class="invalid-feedback">
                            {{ \$message }}
                        </div>
                    @enderror

                </div>
        HTML;
    }

    private function booleanField(
        $column,
        CrudDefinition $definition
    ) {
        $variable = $definition->variableName;

        return <<<HTML
                <div class="mb-3">

                    <div class="form-check">

                        <input
                            type="hidden"
                            name="{$column->name}"
                            value="0"
                        >

                        <input
                            type="checkbox"
                            name="{$column->name}"
                            value="1"
                            class="form-check-input"
                            @checked(old(
                                '{$column->name}',
                                \${$variable}->{$column->name} ?? false
                            ))
                        >

                        <label class="form-check-label">
                            {$this->label($column->name)}
                        </label>

                    </div>

                </div>
        HTML;
    }

    private function generateHeaders(
        CrudDefinition $definition
    ) {
        $lines = [];

        foreach ($definition->columns as $column) {
            $lines[] =
                "                <th>" .
                $this->label($column->name) .
                "</th>";
        }

        return implode("\n", $lines);
    }

    private function generateRows(
        CrudDefinition $definition
    ) {
        $lines = [];

        $variable = $definition->variableName;

        foreach ($definition->columns as $column) {
            $lines[] =
                "                    <td>" .
                "{{ \${$variable}->{$column->name} }}" .
                "</td>";
        }

        return implode("\n", $lines);
    }

    private function generateShowRows(
        CrudDefinition $definition
    ) {
        $lines = [];

        $variable = $definition->variableName;

        foreach ($definition->columns as $column) {
            $label =
                $this->label($column->name);

            $lines[] = <<<HTML
                    <tr>
                        <th>{$label}</th>
                        <td>{{ \${$variable}->{$column->name} }}</td>
                    </tr>
            HTML;
        }

        return implode("\n", $lines);
    }

    private function label($name)
    {
        return ucwords(
            str_replace('_', ' ', $name)
        );
    }
}