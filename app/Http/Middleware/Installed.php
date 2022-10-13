<?php
/*
 * File name: Installed.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Installed
{

    private $exceptNames = [
        'LaravelInstaller*',
        'LaravelUpdater*',
        'debugbar*'
    ];

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $installed = File::exists(storage_path('installed'));
        if ($this->match($request->route()) || $installed) {
            return $next($request);
        }
        return redirect(url('install'));

    }

    private function match(Route $route)
    {
        foreach ($this->exceptNames as $except) {
            if (Str::is($except, $route->getName())) {
                return true;
            }
        }
        return false;
    }
}
