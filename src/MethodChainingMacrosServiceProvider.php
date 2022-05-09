<?php

namespace Liyuze\MethodChainingMacros;

use Illuminate\Support\ServiceProvider;

class MethodChainingMacrosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('method-chaining-macros.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'method-chaining-macros');

        $this->macroRegister();
    }

    protected function macroRegister()
    {
        // macros alias
        $aliases = config('method-chaining-macros.alias');

        // base class list
        $classes = collect(config('method-chaining-macros.classes'));

        // macro register
        collect($this->macros())
            ->mapWithKeys(function ($func, $macro) use ($aliases) {
                $macro = $aliases[$macro] ?? $macro;

                return [$macro => $func];
            })
            ->each(function ($func, $macro) use ($classes) {
                $classes->each(function ($class) use ($func, $macro) {
                    if (class_exists($class) && ! ($class::hasMacro($macro))) {
                        $class::macro($macro, $func);
                    }
                });
            });
    }

    protected function macros()
    {
        $macros = new MethodChainingMacros();

        return [
            'chaining'       => $macros->chaining(),
            'mixedChaining'  => $macros->mixedChaining(),
            'tapChaining'    => $macros->tapChaining(),
            'pipeChaining'   => $macros->pipeChaining(),
            'ifChaining'     => $macros->ifChaining(),
            'unlessChaining' => $macros->unlessChaining(),
            'switchChaining' => $macros->switchChaining(),
        ];
    }
}
