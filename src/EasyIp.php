<?php
/**
 * Created by PhpStorm.
 * User: moon
 * Date: 2019-04-16
 * Time: 14:13
 */

namespace Shiran\EasyIp;


class EasyIp
{
    protected $factory;

    public function __construct(array $config)
    {
        $this->factory = new Factory($config);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws Exception\InvalidArgumentException
     */
    public function __call($name, $arguments)
    {
        return $this->factory->make($name, $arguments);
    }
}