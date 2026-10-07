<?php

namespace Devel\SmartCrudGenerator\Generator;

use Devel\SmartCrudGenerator\Definitions\CrudDefinition;


class GenerationManager
{
    protected $migrationGenerator;
    protected $modelGenerator;
    protected $controllerGenerator;
    protected $routeGenerator;
    protected $viewGenerator;

    public function __construct(
        MigrationGenerator $migrationGenerator,
        ModelGenerator $modelGenerator,
        ControllerGenerator $controllerGenerator,
        RouteGenerator $routeGenerator,
        ViewGenerator $viewGenerator
    ) {
        $this->migrationGenerator = $migrationGenerator;
        $this->modelGenerator = $modelGenerator;
        $this->controllerGenerator = $controllerGenerator;
        $this->routeGenerator = $routeGenerator;
        $this->viewGenerator = $viewGenerator;
    }

    
    public function generate(CrudDefinition $definition)
    {
        $results = [];
    
        $results['migration'] =
            $this->migrationGenerator
                ->generate($definition);
    
        $results['model'] =
            $this->modelGenerator
                ->generate($definition);
    
        $results['controller'] =
            $this->controllerGenerator
                ->generate($definition);
    
        $results['route'] =
            $this->routeGenerator
                ->generate($definition);
    
        $results['views'] =
            $this->viewGenerator
                ->generate($definition);
    
        return $results;
    }
}
