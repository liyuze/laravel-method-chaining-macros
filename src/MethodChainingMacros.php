<?php

namespace Liyuze\MethodChainingMacros;

use Liyuze\MethodChainingProxy\Proxies\IfChainingProxy;
use Liyuze\MethodChainingProxy\Proxies\MethodChainingProxy;
use Liyuze\MethodChainingProxy\Proxies\SwitchChainingProxy;

class MethodChainingMacros
{
    public function chaining(): \Closure
    {
        /**
         * @param  int  $mode
         * @return \Liyuze\MethodChainingProxy\Proxies\MethodChainingProxy<$this>
         */
        return function (int $mode = MethodChainingProxy::CALL_MODE_MIXED): MethodChainingProxy {
            return new MethodChainingProxy($this, $mode);
        };
    }

    public function mixedChaining(): \Closure
    {
        /**
         * @return \Liyuze\MethodChainingProxy\Proxies\MethodChainingProxy<$this>
         */
        return function (): MethodChainingProxy {
            return new MethodChainingProxy($this, MethodChainingProxy::CALL_MODE_MIXED);
        };
    }

    public function tapChaining(): \Closure
    {
        /**
         * @return \Liyuze\MethodChainingProxy\Proxies\MethodChainingProxy<$this>
         */
        return function (): MethodChainingProxy {
            return new MethodChainingProxy($this, MethodChainingProxy::CALL_MODE_TAP);
        };
    }

    public function pipeChaining(): \Closure
    {
        /**
         * @return \Liyuze\MethodChainingProxy\Proxies\MethodChainingProxy<$this>
         */
        return function (): MethodChainingProxy {
            return new MethodChainingProxy($this, MethodChainingProxy::CALL_MODE_PIPE);
        };
    }

    public function ifChaining(): \Closure
    {
        /**
         * @param  mixed  $value
         * @param  int  $callMode
         * @return \Liyuze\MethodChainingProxy\Proxies\IfChainingProxy<$this>
         */
        return function (mixed $value, int $callMode = MethodChainingProxy::CALL_MODE_MIXED): IfChainingProxy {
            return new IfChainingProxy($this, boolval(value($value)), $callMode);
        };
    }

    public function unlessChaining(): \Closure
    {
        /**
         * @param  mixed  $value
         * @param  int  $callMode
         * @return \Liyuze\MethodChainingProxy\Proxies\IfChainingProxy<$this>
         */
        return function (mixed $value, int $callMode = MethodChainingProxy::CALL_MODE_MIXED): IfChainingProxy {
            return new IfChainingProxy($this, ! boolval(value($value)), $callMode);
        };
    }

    public function switchChaining(): \Closure
    {
        /**
         * @param mixed $value
         * @param  bool  $isStrict
         * @param  int  $callMode
         * @return \Liyuze\MethodChainingProxy\Proxies\SwitchChainingProxy<$this>
         */
        return function (mixed $value, bool $isStrict = false, int $callMode = MethodChainingProxy::CALL_MODE_MIXED): SwitchChainingProxy {
            return new SwitchChainingProxy($this, $value, $isStrict, $callMode);
        };
    }
}
