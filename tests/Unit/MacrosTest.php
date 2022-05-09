<?php

namespace Liyuze\MethodChainingMacros\Tests\Unit;

use Liyuze\MethodChainingMacros\Tests\TestCase;
use Liyuze\MethodChainingProxy\Proxies\IfChainingProxy;
use Liyuze\MethodChainingProxy\Proxies\MethodChainingProxy;
use Liyuze\MethodChainingProxy\Proxies\SwitchChainingProxy;
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

        $coll = collect([1, 2]);
        assertEquals(new IfChainingProxy($coll, false, 2), $coll->ifChaining(false, 2));
    }

    public function test_unless_chaining_macro(): void
    {
        assertSame(2, collect([1, 2])->unlessChaining(false)->count()->endUnlessChaining());
        assertEquals([1, 2], collect([1, 2])->unlessChaining(true)->count()->endUnlessChaining()->all());

        $coll = collect([1, 2]);
        assertEquals(new IfChainingProxy($coll, false, 2), $coll->ifChaining(false, 2));
    }

    public function test_switch_chaining_macro(): void
    {
        $num = collect([1, 2])->switchChaining(2)
            ->caseChaining(1)->count()->breakChaining()
            ->caseChaining(2)->avg()->breakChaining()
            ->caseChaining(3)->sum()->breakChaining()
            ->endSwitchChaining();
        assertSame(1.5, $num);

        $coll = collect([1, 2]);
        assertEquals(new SwitchChainingProxy($coll, 2, true, 2), $coll->switchChaining(2, true, 2));
    }
}