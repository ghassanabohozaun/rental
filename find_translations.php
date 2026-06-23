<?php

$keys = [];

function searchDir($dir) {
    global $keys;
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $content = file_get_contents($file->getPathname());
            preg_match_all("/__\(\s*['\"]cheques\.([^'\"]+)['\"]\s*\)/", $content, $matches);
            foreach ($matches[1] as $match) {
                $keys[$match] = true;
            }
        }
    }
}

searchDir('c:/laragon/www/rental/app/Livewire/Dashboard/Cheques');
searchDir('c:/laragon/www/rental/resources/views/livewire/dashboard/cheques');
searchDir('c:/laragon/www/rental/resources/views/dashboard/cheques');
searchDir('c:/laragon/www/rental/resources/views/dashboard/reports/cheques');

$ar = require 'c:/laragon/www/rental/lang/ar/cheques.php';

$missing = [];
foreach (array_keys($keys) as $key) {
    if (!isset($ar[$key])) {
        $missing[] = $key;
    }
}

echo "Missing Translations:\n";
print_r($missing);
