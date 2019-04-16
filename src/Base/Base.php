<?php
/**
 * Created by PhpStorm.
 * User: moon
 * Date: 2019-04-16
 * Time: 14:44
 */

namespace Shiran\EasyIp\Base;


class Base
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public static function __callStatic($name, $arguments)
    {
        return static::$name(...$arguments);
    }
}