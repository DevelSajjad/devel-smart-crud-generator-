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

        $routePath = base_path('routes/web.php');

        $originalRouteContent = file_get_contents($routePath);
    
        $modelPath = $this->modelGenerator
            ->getPath($definition);
    
        $controllerPath = $this->controllerGenerator
            ->getPath($definition);
    
        $viewPaths = $this->viewGenerator
            ->getViewPaths($definition);
    
        $migrationPattern = database_path(
            'migrations/*_create_' .
            $definition->tableName .
            '_table.php'
        );
    
        $existingMigrations = glob($migrationPattern);

        try {

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

        } catch (\Throwable $th) {
            /*
            * Remove only newly created target files.
            */
            $targetFiles = array_merge(
                [$modelPath, $controllerPath],
                $viewPaths
            );

            $migrationsAfterFailure = glob($migrationPattern);

            foreach ($migrationsAfterFailure as $migration) {
                if (!in_array($migration, $existingMigrations)) {
                    $targetFiles[] = $migration;
                }
            }

            foreach (array_unique($targetFiles) as $file) {
                if (file_exists($file)) {
                    @unlink($file);
                }
            }

            /*
            * Restore routes/web.php if it was modified.
            */
            file_put_contents(
                $routePath,
                $originalRouteContent
            );

            throw $th;
        }
    }
}
