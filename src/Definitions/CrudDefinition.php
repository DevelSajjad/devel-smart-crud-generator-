<?php

namespace Devel\SmartCrudGenerator\Definitions;

use Devel\SmartCrudGenerator\Support\NameResolver;

class CrudDefinition
{
    public $modelName;

    public $tableName;

    public $columns = [];

    public $controllerName;

    public $routeName;

    public $viewName;

    public function __construct(
        string $modelName,
        array $columns = []
    ) {
        $resolver = new NameResolver();

        $this->modelName = $resolver->modelName($modelName);

        $this->tableName =  $resolver->tableName($modelName);

        $this->controllerName = $resolver->controllerName($modelName);

        $this->routeName = $resolver->routeName($modelName);

        $this->viewName = $resolver->viewName($modelName);

        foreach ($columns as $column) {

            $this->columns[] =
                $column instanceof ColumnDefinition
                    ? $column
                    : new ColumnDefinition($column);
        }
    }

    // protected function makeTableName($modelName)
    // {
    //     return strtolower(
    //         preg_replace(
    //             '/(?<!^)[A-Z]/',
    //             '_$0',
    //             $modelName
    //         )
    //     ) . 's';
    // }
}