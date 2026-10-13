<?php

namespace Devel\SmartCrudGenerator\Generator;

use Devel\SmartCrudGenerator\Definitions\CrudDefinition;
// use Devel\SmartCrudGenerator\Generator\GenerationPreflight;

class PreviewService
{
    protected $migrationGenerator;
    protected $modelGenerator;
    protected $controllerGenerator;
    protected $routeGenerator;
    protected $viewGenerator;
    protected $preFlight;

    public function __construct(
        MigrationGenerator $migrationGenerator,
        ModelGenerator $modelGenerator,
        ControllerGenerator $controllerGenerator,
        RouteGenerator $routeGenerator,
        ViewGenerator $viewGenerator,
        GenerationPreflight $preFlight,
    ) {
        $this->migrationGenerator = $migrationGenerator;
        $this->modelGenerator = $modelGenerator;
        $this->controllerGenerator = $controllerGenerator;
        $this->routeGenerator = $routeGenerator;
        $this->viewGenerator = $viewGenerator;
        $this->preFlight = $preFlight;
    }

    public function preview(
        CrudDefinition $definition
    ) {

        $conflicts = $this->preFlight->check($definition);

        return [
            'route' => [
                'filename' => 'routes/web.php',
                'content' => $this->routeGenerator
                    ->buildContent($definition),
            ],

            'views' => [
                'index' => [
                    'filename' => $definition->viewName . '/index.blade.php',
                    'content' => $this->viewGenerator
                        ->buildViewContent('index', $definition),
                ],

                'create' => [
                    'filename' => $definition->viewName . '/create.blade.php',
                    'content' => $this->viewGenerator
                        ->buildViewContent('create', $definition),
                ],

                'edit' => [
                    'filename' => $definition->viewName . '/edit.blade.php',
                    'content' => $this->viewGenerator
                        ->buildViewContent('edit', $definition),
                ],

                'show' => [
                    'filename' => $definition->viewName . '/show.blade.php',
                    'content' => $this->viewGenerator
                        ->buildViewContent('show', $definition),
                ],
            ],

            'model' => [
                'filename' => $definition->modelName . '.php',
                'content' => $this->modelGenerator
                    ->buildContent($definition),
            ],

            'migration' => [
                'filename' => 'create_' .
                    $definition->tableName . '_table.php',
                'content' => $this->migrationGenerator
                    ->buildContent($definition),
            ],

            'controller' => [
                'filename' => $definition->controllerName . '.php',
                'content' => $this->controllerGenerator
                    ->buildContent($definition),
            ],
            'conflicts' => $conflicts,
        ];
    }
}