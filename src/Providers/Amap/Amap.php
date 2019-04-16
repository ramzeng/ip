<?php

/*
 * This file is part of the shiran/easyip.
 *
 * (c) shiran <iymiym@icloud.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Shiran\EasyIp\Providers\Amap;

use Zttp\Zttp;
use Shiran\EasyIp\Base\Base;
use Shiran\EasyIp\Contracts\Resolvable;
use Shiran\EasyIp\Exception\ReferenceException;

class Amap extends Base implements Resolvable
{
    const PROVIDER_NAME = 'Amap';

    const URL = 'https://restapi.amap.com/v3/ip?parameters';

    protected $ip;

    protected $response;

    /**
     * @param string $ip
     *
     * @return array
     *
     * @throws \Exception
     */
    public function parse(string $ip)
    {
        $params = [
            'ip' => $ip,
            'key' => $this->config['amap']['key'],
        ];

        $this->ip = $ip;
        $this->response = Zttp::get(static::URL, $params)->json();

        return $this->check()->format();
    }

    /**
     * @return string
     */
    public function getProviderName()
    {
        return static::PROVIDER_NAME;
    }

    /**
     * @return $this
     *
     * @throws ReferenceException
     */
    public function check()
    {
        if (1 != $this->response['status']) {
            throw new ReferenceException($this->response['message']);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function format()
    {
        $result = $this->response;
        $location = explode(',', explode(';', $result['rectangle'])[0]);

        return [
            'provider' => static::PROVIDER_NAME,
            'ip' => $this->ip,
            'postcode' => $result['adcode'],
            'country' => ($result['province'] ? '中国' : ''),
            'province' => $result['province'],
            'city' => $result['city'],
            'district' => '',
            'implode' => ($result['province'] ? '中国' : '').$result['province'].$result['city'],
            'location' => [
                'latitude' => $location[1] ?? '',
                'longitude' => $location[0] ?? '',
            ],
        ];
    }
}
