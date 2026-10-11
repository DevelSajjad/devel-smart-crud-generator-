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
    protected $preflight;

    public function __construct(
        MigrationGenerator $migrationGenerator,
        ModelGenerator $modelGenerator,
        ControllerGenerator $controllerGenerator,
        RouteGenerator $routeGenerator,
        ViewGenerator $viewGenerator,
        GenerationPreflight $preflight
    ) {
        $this->migrationGenerator = $migrationGenerator;
        $this->modelGenerator = $modelGenerator;
        $this->controllerGenerator = $controllerGenerator;
        $this->routeGenerator = $routeGenerator;
        $this->viewGenerator = $viewGenerator;
        $this->preflight = $preflight;
    }

    
    public function generate(CrudDefinition $definition)
    {
        $conflicts = $this->preflight->check($definition);

        if (!empty($conflicts)) {
            throw new \RuntimeException(
                "Generation stopped. " .
                "The following files already exist:\n" .
                implode("\n", $conflicts)
            );
        }

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
