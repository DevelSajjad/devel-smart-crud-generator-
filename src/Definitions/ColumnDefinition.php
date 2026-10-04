<?php

namespace Devel\SmartCrudGenerator\Definitions;

class ColumnDefinition
{
    public $name;

    public $type;

    public $nullable = false;

    public $unique = false;

    public $index = false;

    public $unsigned = false;

    public $default = null;

    public $length = null;

    public $precision = null;

    public $scale = null;

    public function __construct(array $data)
    {
        $this->name = $data['name'];

        $this->type = $data['type'];

        $this->nullable = $data['nullable'] ?? false;

        $this->unique = $data['unique'] ?? false;

        $this->index = $data['index'] ?? false;

        $this->unsigned = $data['unsigned'] ?? false;

        $this->default = $data['default'] ?? null;

        $this->length = $data['length'] ?? null;

        $this->precision = $data['precision'] ?? null;

        $this->scale = $data['scale'] ?? null;
    }
}