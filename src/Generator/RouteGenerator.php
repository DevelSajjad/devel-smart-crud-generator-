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
        return $this->generateImport($definition)
            . "\n\n"
            . $this->generateRoute($definition);
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

        $content = $this->insertImport($content, $import);

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

    private function insertImport($content, $import)
    {
        $newline = strpos($content, "\r\n") !== false
            ? "\r\n"
            : "\n";

        if (preg_match(
            '/^' . preg_quote($import, '/') . '\s*$/m',
            $content
        )) {
            return $content;
        }

        /*
         * Keep the controller import with the other use
         * statements. This still works when the file has a
         * BOM or does not begin with <?php.
         */
        if (preg_match_all(
            '/^use\s+[^;]+;/m',
            $content,
            $matches,
            PREG_OFFSET_CAPTURE
        )) {
            $last = end($matches[0]);
            $insertAt = $last[1] + strlen($last[0]);
            $after = preg_replace(
                '/^\r?\n/',
                '',
                substr($content, $insertAt),
                1
            );

            return substr($content, 0, $insertAt)
                . $newline
                . $import
                . $newline
                . $after;
        }

        $updated = preg_replace_callback(
            '/^\s*<\?php\b/',
            function ($matches) use ($import, $newline) {
                return $matches[0] . $newline . $newline . $import;
            },
            $content,
            1,
            $count
        );

        if ($count > 0 && is_string($updated)) {
            return $updated;
        }

        return $import . $newline . $newline . ltrim($content);
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