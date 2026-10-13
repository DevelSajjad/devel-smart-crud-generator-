<?php

namespace Devel\SmartCrudGenerator\Generator;

use Devel\SmartCrudGenerator\Definitions\CrudDefinition;
use Illuminate\Support\Facades\Route;

class RouteGenerator
{
    public function routeExists(CrudDefinition $definition): bool
    {
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            if ($route->getName() === $definition->routeName) {
                return true;
            }
        }

        return false;
    }

    public function buildContent(
        CrudDefinition $definition
    ) {
        return $this->generateRoute($definition);
    }

    public function generate(CrudDefinition $definition)
    {
        $path = base_path('routes/web.php');

        if (!file_exists($path)) {
            throw new \RuntimeException(
                "routes/web.php not found."
            );
        }

        // Check whether the route name already exists.
        if ($this->routeExists($definition)) {
            throw new \RuntimeException(
                "Route already exists for " .
                $definition->routeName
            );
        }

        $content = file_get_contents($path);
        
        $import = $this->generateImport($definition);

        if (strpos($content, $import) === false) {
            // Insert the use statement right after the opening <?php tag
            $content = preg_replace(
                '/^<\?php\s*/',
                "<?php\n\n" . $import . "\n",
                $content,
                1
            );
        }

        $routeMarker =
            "Route::resource(\n" .
            "    '{$definition->routeName}',";

        if (strpos($content, $routeMarker) !== false) {
            throw new \RuntimeException(
                "Route already exists for " .
                $definition->routeName
            );
        }

        $route =
            $this->generateRoute($definition);

        $content =
            rtrim($content) .
            "\n\n" .
            $route .
            "\n";

        file_put_contents(
            $path,
            $content
        );

        return $path;
    }

    private function generateImport(
        CrudDefinition $definition
    ) {
        return "use App\\Http\\Controllers\\" .
            $definition->controllerName .
            ";";
    }

    private function generateRoute(
        CrudDefinition $definition
    ) {
        return "Route::resource(\n" .
            "    '{$definition->routeName}',\n" .
            "    {$definition->controllerName}::class\n" .
            ");";
    }
}