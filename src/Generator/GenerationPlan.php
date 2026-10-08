<?php

namespace Devel\SmartCrudGenerator\Generator;

class GenerationPlan
{
    public $migration;
    public $model;
    public $controller;
    public $route;
    public $views = [];

    public function allFiles()
    {
        $files = [];

        if ($this->migration) {
            $files[] = $this->migration;
        }

        if ($this->model) {
            $files[] = $this->model;
        }

        if ($this->controller) {
            $files[] = $this->controller;
        }

        foreach ($this->views as $view) {
            $files[] = $view;
        }

        return $files;
    }
}