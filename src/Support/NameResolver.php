<?php

namespace Devel\SmartCrudGenerator\Support;

class NameResolver
{
    public function modelName($name)
    {
        return ucfirst($name);
    }

    public function tableName($modelName)
    {
        $name = preg_replace(
            '/(?<!^)[A-Z]/',
            '_$0',
            $modelName
        );

        return strtolower($name) . 's';
    }

    public function viewName($modelName)
    {
        return $this->tableName($modelName);
    }

    public function controllerName($modelName)
    {
        return $modelName . 'Controller';
    }
}