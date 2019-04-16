<?php
/**
 * Created by PhpStorm.
 * User: moon
 * Date: 2019-04-16
 * Time: 15:13
 */

namespace Shiran\EasyIp\Contracts;


interface Resolvable
{
    /**
     * @param string $ip
     * @return array
     */
    public function parse(string $ip);

    /**
     * @return string
     */
    public function getProviderName();
}