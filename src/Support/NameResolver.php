<?php

namespace Devel\SmartCrudGenerator\Support;

use Illuminate\Support\Str;

class NameResolver
{
    /**
     * Convert user input to a Laravel model/class name.
    */
    public function modelName($name)
    {
        return Str::studly($name);
    }

    // public function tableName($modelName)
    // {
    //     $name = preg_replace(
    //         '/(?<!^)[A-Z]/',
    //         '_$0',
    //         $modelName
    //     );

    //     return strtolower($name) . 's';
    // }

    /**
     * Convert model name to table name.
    */
    public function tableName($modelName)
    {
        return Str::plural(
            Str::snake($this->modelName($modelName))
        );
    }

    /**
     * View directory.
    */
    public function viewName($modelName)
    {
        return $this->tableName($modelName);
    }

    /**
     * Controller class name.
    */
    public function controllerName($modelName)
    {
        return $this->modelName($modelName) . 'Controller';
    }

    /**
     * Controller file name.
    */
    public function controllerFileName($modelName)
    {
        return $this->controllerName($modelName) . '.php';
    }

    /**
     * Resource route name.
    */
    public function routeName($modelName)
    {
        return Str::kebab(
            $this->tableName($modelName)
        );
    }

    /**
     * Model file name.
    */
    public function modelFileName($modelName)
    {
        return $this->modelName($modelName) . '.php';
    }
}