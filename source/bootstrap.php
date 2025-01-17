<?php declare(strict_types=1);
/**
 * bootstrap.php
 *
 * (C) 2024 by Eylem Ugurel
 *
 * Licensed under a Creative Commons Attribution 4.0 International License.
 *
 * You should have received a copy of the license along with this work. If not,
 * see <http://creativecommons.org/licenses/by/4.0/>.
 */

\spl_autoload_register(function(string $className): void {
    $classFilePath = \rtrim(__DIR__, '/\\')
                   . '/classes/'
                   . \str_replace('\\', '/', $className)
                   . '.php';
    if (!\is_file($classFilePath)) {
        return;
    }
    require $classFilePath;
});
