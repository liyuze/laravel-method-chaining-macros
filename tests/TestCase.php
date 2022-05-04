<?php

namespace Liyuze\MethodChainingMacros\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            'Liyuze\MethodChainingMacros\MethodChainingMacrosServiceProvider',
        ];
    }
}
