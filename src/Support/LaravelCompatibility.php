<?php

namespace Devel\SmartCrudGenerator\Support;

class LaravelCompatibility
{
    public function laravelMajorVersion()
    {
        $version = app()->version();

        return (int) explode('.', $version)[0];
    }

    public function modelDirectory()
    {
        $modelsDirectory = app_path('Models');

        if (
            $this->laravelMajorVersion() >= 8 ||
            is_dir($modelsDirectory)
        ) {
            return $modelsDirectory;
        }

        return app_path();
    }

    public function modelNamespace()
    {
        $modelsDirectory = app_path('Models');

        if (
            $this->laravelMajorVersion() >= 8 ||
            is_dir($modelsDirectory)
        ) {
            return 'App\\Models';
        }

        return 'App';
    }

    public function modelPath($modelName)
    {
        return $this->modelDirectory()
            . DIRECTORY_SEPARATOR
            . $modelName
            . '.php';
    }

    public function controllerDirectory()
    {
        return app_path('Http/Controllers');
    }
}