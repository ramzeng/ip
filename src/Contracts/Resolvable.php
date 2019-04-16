<?php

/*
 * This file is part of the shiran/easyip.
 *
 * (c) shiran <iymiym@icloud.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Shiran\EasyIp\Contracts;

interface Resolvable
{
    /**
     * @param string $ip
     *
     * @return array
     */
    public function parse(string $ip);

    /**
     * @return string
     */
    public function getProviderName();
}
