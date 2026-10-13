<?php

namespace Devel\SmartCrudGenerator\Generator;

use Devel\SmartCrudGenerator\Definitions\CrudDefinition;

class PreviewService
{
    protected $migrationGenerator;
    protected $modelGenerator;
    protected $controllerGenerator;

    public function __construct(
        MigrationGenerator $migrationGenerator,
        ModelGenerator $modelGenerator,
        ControllerGenerator $controllerGenerator
    ) {
        $this->migrationGenerator = $migrationGenerator;
        $this->modelGenerator = $modelGenerator;
        $this->controllerGenerator = $controllerGenerator;
    }

    public function preview(
        CrudDefinition $definition
    ) {
        return [
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
        ];
    }
}