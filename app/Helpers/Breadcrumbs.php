<?php

use Illuminate\Support\Str;

function generateBreadcrumbs()
{
    $segments = request()->segments();
    $breadcrumbs = [];
    $path = '';

    foreach ($segments as $segment) {
        $path .= '/' . $segment;

        // Hilangkan angka ID dari breadcrumb
        if (is_numeric($segment)) {
            continue;
        }

        $breadcrumbs[] = [
            'name' => Str::title(str_replace('-', ' ', $segment)),
            'url' => $path,
        ];
    }

    return $breadcrumbs;
}
