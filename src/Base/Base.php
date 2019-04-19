<?php

/*
 * This file is part of the Icecho/easyip.
 *
 * (c) Icecho <iymiym@icloud.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Icecho\EasyIp\Base;

class Base
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }
}
