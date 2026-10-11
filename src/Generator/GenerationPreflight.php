<?php

namespace Devel\SmartCrudGenerator\Generator;

use Devel\SmartCrudGenerator\Definitions\CrudDefinition;

class GenerationPreflight
{
    protected $conflictManager;
    protected $migrationGenerator;
    protected $modelGenerator;
    protected $controllerGenerator;
    protected $routeGenerator;
    protected $viewGenerator;

    public function __construct(
        ConflictManager $conflictManager,
        MigrationGenerator $migrationGenerator,
        ModelGenerator $modelGenerator,
        ControllerGenerator $controllerGenerator,
        RouteGenerator $routeGenerator,
        ViewGenerator $viewGenerator
    ) {
        $this->conflictManager = $conflictManager;
        $this->migrationGenerator = $migrationGenerator;
        $this->modelGenerator = $modelGenerator;
        $this->controllerGenerator = $controllerGenerator;
        $this->routeGenerator = $routeGenerator;
        $this->viewGenerator = $viewGenerator;
    }

    public function check(
        CrudDefinition $definition
    ) {
        $conflicts = [];

        /*
         * Model
         */
        $modelPath =
            $this->modelGenerator
                ->getPath($definition);

        $conflicts = array_merge(
            $conflicts,
            $this->conflictManager->checkFiles([
                $modelPath
            ])
        );

        /*
         * Controller
         */
        $controllerPath =
            $this->controllerGenerator
                ->getPath($definition);

        $conflicts = array_merge(
            $conflicts,
            $this->conflictManager->checkFiles([
                $controllerPath
            ])
        );

        /*
         * Views
         */
        $viewPaths =
            $this->viewGenerator
                ->getViewPaths($definition);

        $conflicts = array_merge(
            $conflicts,
            $this->conflictManager
                ->checkFiles($viewPaths)
        );

        /*
         * Migration
         */
        $existingMigration =
            $this->migrationGenerator
                ->findExistingMigration($definition);

        if ($existingMigration) {
            $conflicts[] =
                $existingMigration;
        }

        /*
         * Route
         */
        if (
            $this->routeGenerator
                ->routeExists($definition)
        ) {
            $conflicts[] =
                base_path('routes/web.php');
        }

        return array_unique($conflicts);
    }
}