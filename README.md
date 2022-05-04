# Laravel 方法链式调用代理 Macros

[![Latest Version on Packagist](https://img.shields.io/packagist/v/liyuze/laravel-method-chaining-macros.svg?style=flat-square)](https://packagist.org/packages/liyuze/laravel-method-chaining-macros)
[![Total Downloads](https://img.shields.io/packagist/dt/liyuze/laravel-method-chaining-macros.svg?style=flat-square)](https://packagist.org/packages/liyuze/laravel-method-chaining-macros)
![GitHub Actions](https://github.com/liyuze/laravel-method-chaining-macros/actions/workflows/main.yml/badge.svg)

此扩展包是针对对 `liyuze/method-chaining-proxy` 在 laravel 框架补充，通过 marcoable 特性的类快速创建方法链式调用代理器。

## 安装

你可以通过 composer 进行安装:

```bash
composer require liyuze/laravel-method-chaining-macros
```

## Macros

- [`chaining`](#chaining)
- [`mixedChaining`](#chaining)
- [`tapChaining`](#chaining)
- [`pipeChaining`](#chaining)
- [`ifChaining`](#ifChaining)
- [`unlessChaining`](#unlessChaining)

## 用例

### chaining

代理器有三种工作模式：

1. `tap` 模式，任何调用都 **不会** 影响代理的代理值。
1. `pipe` 模式，任何调用都 **会** 影响代理的代理值。
1. `mixed` 模式，只有有返回值，且不 `null` 时 **才会** 影响代理的代理值。

`tapChaining`、 `pipeChaining`、 `mixedChaining` 是快速创建这三种工作模式的代理器，`chaining` 是 `mixedChaining` 的别名。

```php
collect([1,2,3])->chaining()->map(fn ($v) => $v * 2)->sum()->popValue();    //12
collect([1,2,3])->pipeChaining()->map(fn ($v) => $v * 2)->sum()->popValue();    //Collection([2,4,6])
```

更多功能查看 `liyuze/method-chaining-proxy` [文档](https://github.com/liyuze/method-chaining-proxy)

### ifChaining

```php
$list = collect([1,2,3]);
$list->ifChaining(true)->map(fn ($v) => $v * 2)->sum()
    ->elseChaining()->map(fn ($v) => $v * 3)->avg()
    ->endIfChaining();    //12
    
$list->ifChaining(false)->map(fn ($v) => $v * 2)->sum()
    ->elseChaining()->map(fn ($v) => $v * 3)->avg()
    ->endIfChaining();    //6
```

### unlessChaining

```php
$list = collect([1,2,3]);
$list->unlessChaining(true)->map(fn ($v) => $v * 2)->sum()
    ->elseChaining()->map(fn ($v) => $v * 3)->avg()
    ->endUnlessChaining();    //6
```

## 配置

发布配置文件

```bash
php artisan vendor:publish --provider="Liyuze\MethodChainingMacros\MethodChainingMacrosServiceProvider"
```

删除注释或添加类名来修改 macro 类列表。
通过 rename 项来指定

如果

### 测试

```bash
composer test
```

### 修改记录

点击 [CHANGELOG](CHANGELOG.md) 查看最近修改了哪些内容。

## 贡献

点击 [CONTRIBUTING](CONTRIBUTING.md) 查看详情

### 安全

如果您发现任何与安全相关的问题，请发送电子邮件290315384@qq.com而不是使用问题追踪器。

## 贡献值

- [Yuze Li](https://github.com/liyuze)
- [All Contributors](../../contributors)

## 开源协议

The MIT License (MIT)。点击 [License File](LICENSE.md) 查看更多信息。

## Laravel 扩展包样板

本扩展包使用 [Laravel Package Boilerplate](https://laravelpackageboilerplate.com) 工具生成。
