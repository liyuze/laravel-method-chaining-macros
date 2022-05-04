<?php

namespace Liyuze\MethodChainingMacros\Tests\Unit;

use Liyuze\MethodChainingMacros\Tests\TestCase;
use Liyuze\MethodChainingProxy\Proxies\MethodChainingProxy;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertSame;

class MacrosTest extends TestCase
{
    public function test_chaining_macro(): void
    {
        $arr = [];
        assertSame(0, collect($arr)->chaining()->count()->popValue());
        assertEquals(collect($arr)->mixedChaining(), collect($arr)->chaining());
        assertEquals(collect($arr)->tapChaining(), collect($arr)->chaining(MethodChainingProxy::CALL_MODE_TAP));
    }

    public function test_mixed_chaining_macro(): void
    {
        $arr = [];
        assertSame(0, collect($arr)->mixedChaining()->count()->popValue());
    }

    public function test_tap_chaining_macro(): void
    {
        $arr = [];
        assertSame($arr, collect($arr)->tapChaining()->count()->popValue()->all());
    }

    public function test_pipe_chaining_macro(): void
    {
        $arr = [];
        assertSame(0, collect($arr)->mixedChaining()->count()->popValue());
    }

    public function test_if_chaining_macro(): void
    {
        assertSame(2, collect([1, 2])->ifChaining(true)->count()->endIfChaining());
        assertEquals([1, 2], collect([1, 2])->ifChaining(false)->count()->endIfChaining()->all());
    }

    public function test_unless_chaining_macro(): void
    {
        assertSame(2, collect([1, 2])->unlessChaining(false)->count()->endUnlessChaining());
        assertEquals([1, 2], collect([1, 2])->unlessChaining(true)->count()->endUnlessChaining()->all());
    }
}