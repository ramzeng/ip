<?php
/**
 * Created by PhpStorm.
 * User: moon
 * Date: 2019-04-16
 * Time: 17:40
 */

namespace Shiran\EasyIp\Providers\Juhe;

use Zttp\Zttp;
use Shiran\EasyIp\Base\Base;
use Shiran\EasyIp\Contracts\Resolvable;
use Shiran\EasyIp\Exception\ReferenceException;

class Juhe extends Base implements Resolvable
{
    const PROVIDER_NAME = 'Juhe';
    const URL = 'http://apis.juhe.cn/ip/ipNew';

    protected $ip;
    protected $response;

    /**
     * @param string $ip
     * @return array
     * @throws \Exception
     */
    public function parse(string $ip)
    {
        $params = [
            'ip' => $ip,
            'key' => $this->config['juhe']['key'],
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
     * @throws ReferenceException
     */
    public function check()
    {
        if ($this->response['resultcode'] != 200) {
            throw new ReferenceException($this->response['reason']);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function format()
    {
        $result = $this->response['result'];

        return [
            'provider' => static::PROVIDER_NAME,
            'ip' => $this->ip,
            'postcode' => '',
            'country' => $result['Country'],
            'province' => $result['Province'],
            'city' => $result['City'],
            'district' => '',
            'implode' => implode('', array_splice($result, 0, 3)),
            'location' => [
                'latitude' => '',
                'longitude' => '',
            ],
        ];
    }
}