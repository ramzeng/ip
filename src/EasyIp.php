<?php

/*
 * This file is part of the Icecho/easyip.
 *
 * (c) Icecho <iymiym@icloud.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Icecho\EasyIp;

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
     *
     * @return mixed
     *
     * @throws Exception\InvalidArgumentException
     */
    public function __call($name, $arguments)
    {
        return $this->factory->make($name, $arguments);
    }
}
