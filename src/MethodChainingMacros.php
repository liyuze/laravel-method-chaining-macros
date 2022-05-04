<?php

namespace Liyuze\MethodChainingMacros;

use Liyuze\MethodChainingProxy\Proxies\IfChainingProxy;
use Liyuze\MethodChainingProxy\Proxies\MethodChainingProxy;

class MethodChainingMacros
{
    public function chaining(): \Closure
    {
        /**
         * @param  int  $mode
         * @return \Liyuze\MethodChainingProxy\Proxies\MethodChainingProxy<$this>|static
         */
        return function (int $mode = MethodChainingProxy::CALL_MODE_MIXED): MethodChainingProxy {
            return new MethodChainingProxy($this, $mode);
        };
    }

    public function mixedChaining(): \Closure
    {
        /**
         * @return \Liyuze\MethodChainingProxy\Proxies\MethodChainingProxy<$this>|static
         */
        return function (): MethodChainingProxy {
            return new MethodChainingProxy($this, MethodChainingProxy::CALL_MODE_MIXED);
        };
    }

    public function tapChaining(): \Closure
    {
        /**
         * @return \Liyuze\MethodChainingProxy\Proxies\MethodChainingProxy<$this>|static
         */
        return function (): MethodChainingProxy {
            return new MethodChainingProxy($this, MethodChainingProxy::CALL_MODE_TAP);
        };
    }

    public function pipeChaining(): \Closure
    {
        /**
         * @return \Liyuze\MethodChainingProxy\Proxies\MethodChainingProxy<$this>|static
         */
        return function (): MethodChainingProxy {
            return new MethodChainingProxy($this, MethodChainingProxy::CALL_MODE_PIPE);
        };
    }

    public function ifChaining(): \Closure
    {
        /**
         * @param  mixed  $value
         * @return \Liyuze\MethodChainingProxy\Proxies\IfChainingProxy<$this>|static
         */
        return function (mixed $value): IfChainingProxy {
            return new IfChainingProxy($this, boolval(value($value)));
        };
    }

    public function unlessChaining(): \Closure
    {
        /**
         * @param  mixed  $value
         * @return \Liyuze\MethodChainingProxy\Proxies\IfChainingProxy<$this>
         */
        return function (mixed $value): IfChainingProxy {
            return new IfChainingProxy($this, ! boolval(value($value)));
        };
    }
}