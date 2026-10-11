<?php

namespace Devel\SmartCrudGenerator\Generator;

class ConflictManager
{
    public function checkFiles(array $files)
    {
        $conflicts = [];

        foreach ($files as $file) {
            if (file_exists($file)) {
                $conflicts[] = $file;
            }
        }

        return $conflicts;
    }

    public function hasConflicts(array $files)
    {
        return count(
            $this->checkFiles($files)
        ) > 0;
    }
}