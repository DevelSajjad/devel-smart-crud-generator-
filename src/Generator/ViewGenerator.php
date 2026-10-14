<?php

namespace Devel\SmartCrudGenerator\Generator;

use Devel\SmartCrudGenerator\Definitions\CrudDefinition;

class ViewGenerator
{
    public function getViewPaths(CrudDefinition $definition) {
        $directory = resource_path(
            'views/' . $definition->viewName
        );

        return [
            $directory . '/index.blade.php',
            $directory . '/create.blade.php',
            $directory . '/edit.blade.php',
            $directory . '/show.blade.php',
        ];
    }

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

    public function buildViewContent(
        $view,
        CrudDefinition $definition
    ) {
        $stub = file_get_contents(
            __DIR__ .
            '/../../resources/stubs/views/' .
            $view .
            '.blade.stub'
        );

        $fields = $this->generateFields($definition);
        $headers = $this->generateHeaders($definition);
        $rows = $this->generateRows($definition);
        $showRows = $this->generateShowRows($definition);

        return str_replace(
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
                $view === 'show' ? $showRows : $rows,
                count($definition->columns) + 1,
            ],
            $stub
        );
    }

    private function generateView(
        $view,
        CrudDefinition $definition,
        $directory
    ) {
        // $stub = file_get_contents(
        //     __DIR__ .
        //     '/../../resources/stubs/views/' .
        //     $view .
        //     '.blade.stub'
        // );

        // $fields = $this->generateFields(
        //     $definition
        // );

        // $headers = $this->generateHeaders(
        //     $definition
        // );

        // $rows = $this->generateRows(
        //     $definition
        // );

        // $showRows = $this->generateShowRows(
        //     $definition
        // );

        // $content = str_replace(
        //     [
        //         '{{ model }}',
        //         '{{ variable }}',
        //         '{{ route }}',
        //         '{{ fields }}',
        //         '{{ headers }}',
        //         '{{ rows }}',
        //         '{{ colspan }}',
        //     ],
        //     [
        //         $definition->modelName,
        //         $definition->variableName,
        //         $definition->routeName,
        //         $fields,
        //         $headers,
        //         $view === 'show'
        //             ? $showRows
        //             : $rows,
        //         count($definition->columns) + 1,
        //     ],
        //     $stub
        // );

        $content = $this->buildViewContent(
            $view,
            $definition
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
        return $this->controlField(
            $column,
            $definition,
            'text'
        );
    }

    private function textareaField(
        $column,
        CrudDefinition $definition
    ) {
        $variable = $definition->variableName;
        $label = $this->label($column->name);
        $value = $this->oldValue($column, $variable);

        return <<<HTML
                <div class="crud-field crud-field-wide">

                    <label class="crud-label" for="{$column->name}">
                        {$label}{$this->requiredMark($column)}
                    </label>

                    <textarea
                        id="{$column->name}"
                        name="{$column->name}"
                        rows="4"
                        class="crud-input @error('{$column->name}') is-invalid @enderror"
                        placeholder="Enter {$this->placeholder($label)}"
                        {$this->requiredAttribute($column)}
                    >{{ {$value} }}</textarea>

                    @error('{$column->name}')
                        <p class="crud-error">{{ \$message }}</p>
                    @enderror

                </div>
        HTML;
    }

    private function numberField(
        $column,
        CrudDefinition $definition
    ) {
        $step = in_array($column->type, ['decimal', 'float', 'double'], true)
            ? 'any'
            : '1';

        return $this->controlField(
            $column,
            $definition,
            'number',
            null,
            'step="' . $step . '"'
        );
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
        $formats = [
            'date' => 'Y-m-d',
            'datetime-local' => 'Y-m-d\TH:i',
            'time' => 'H:i',
        ];

        return $this->controlField(
            $column,
            $definition,
            $type,
            $formats[$type] ?? null
        );
    }

    private function controlField(
        $column,
        CrudDefinition $definition,
        $type,
        $format = null,
        $extraAttributes = ''
    ) {
        $variable = $definition->variableName;
        $label = $this->label($column->name);
        $value = $this->oldValue($column, $variable, $format);
        $extraAttributes = trim($extraAttributes);
        $extraAttributes = $extraAttributes === ''
            ? ''
            : "\n                        " . $extraAttributes;

        return <<<HTML
                <div class="crud-field">

                    <label class="crud-label" for="{$column->name}">
                        {$label}{$this->requiredMark($column)}
                    </label>

                    <input
                        id="{$column->name}"
                        type="{$type}"
                        name="{$column->name}"
                        value="{{ {$value} }}"
                        class="crud-input @error('{$column->name}') is-invalid @enderror"
                        placeholder="Enter {$this->placeholder($label)}"{$extraAttributes}
                        {$this->requiredAttribute($column)}
                    >

                    @error('{$column->name}')
                        <p class="crud-error">{{ \$message }}</p>
                    @enderror

                </div>
        HTML;
    }

    private function booleanField(
        $column,
        CrudDefinition $definition
    ) {
        $variable = $definition->variableName;
        $label = $this->label($column->name);

        return <<<HTML
                <div class="crud-field crud-field-wide">

                    <label class="crud-switch">

                        <input
                            type="hidden"
                            name="{$column->name}"
                            value="0"
                        >

                        <input
                            id="{$column->name}"
                            type="checkbox"
                            name="{$column->name}"
                            value="1"
                            class="crud-switch-input"
                            @checked(old(
                                '{$column->name}',
                                isset(\${$variable}) ? \${$variable}->{$column->name} : false
                            ))
                        >

                        <span class="crud-switch-track" aria-hidden="true"></span>

                        <span class="crud-switch-copy">
                            <span class="crud-switch-title">{$label}</span>
                            <span class="crud-switch-hint">Turn this on to include it with the record.</span>
                        </span>

                    </label>

                    @error('{$column->name}')
                        <p class="crud-error">{{ \$message }}</p>
                    @enderror

                </div>
        HTML;
    }

    private function oldValue($column, $variable, $format = null)
    {
        if ($format) {
            $current = "isset(\${$variable}) && \${$variable}->{$column->name} !== null && \${$variable}->{$column->name} !== '' ? \\Illuminate\\Support\\Carbon::parse(\${$variable}->{$column->name})->format('{$format}') : ''";
        } else {
            $current = "isset(\${$variable}) ? \${$variable}->{$column->name} : ''";
        }

        return "old('{$column->name}', {$current})";
    }

    private function placeholder($label)
    {
        return strtolower($label);
    }

    private function requiredMark($column)
    {
        if ($column->nullable || $column->type === 'boolean') {
            return '';
        }

        return '<span class="crud-required" title="Required">*</span>';
    }

    private function requiredAttribute($column)
    {
        if ($column->nullable || $column->type === 'boolean') {
            return '';
        }

        return 'required';
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
            $label = $this->label($column->name);
            $wide = in_array($column->type, ['text', 'longText'], true)
                ? ' crud-detail-wide'
                : '';

            $lines[] = <<<HTML
                <div class="crud-detail{$wide}">
                    <div class="crud-detail-label">{$label}</div>
                    <div class="crud-detail-value">
                        {$this->showValue($column, $variable)}
                    </div>
                </div>
            HTML;
        }

        return implode("\n", $lines);
    }

    private function showValue($column, $variable)
    {
        $field = "\${$variable}->{$column->name}";

        if ($column->type === 'boolean') {
            return <<<HTML
            @if({$field} === null || {$field} === '')
                <span class="crud-detail-empty">Not set</span>
            @elseif({$field})
                <span class="crud-pill is-on">Yes</span>
            @else
                <span class="crud-pill">No</span>
            @endif
            HTML;
        }

        return <<<HTML
            @if({$field} === null || {$field} === '')
                <span class="crud-detail-empty">Not set</span>
            @else
                {{ {$field} }}
            @endif
            HTML;
    }

    private function label($name)
    {
        return ucwords(
            str_replace('_', ' ', $name)
        );
    }
}