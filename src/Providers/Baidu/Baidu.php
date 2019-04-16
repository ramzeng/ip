<?php
/**
 * Created by PhpStorm.
 * User: moon
 * Date: 2019-04-16
 * Time: 16:08
 */

namespace Shiran\EasyIp\Providers\Baidu;

use Zttp\Zttp;
use Shiran\EasyIp\Base\Base;
use Shiran\EasyIp\Contracts\Resolvable;
use Shiran\EasyIp\Exception\ReferenceException;

class Baidu extends Base implements Resolvable
{
    const PROVIDER_NAME = 'Baidu';
    const URL = 'https://api.map.baidu.com/location/ip';

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
            'ak' => $this->config['baidu']['ak'],
            'coor' => $this->config['baidu']['coor'],
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
        if ($this->response['status'] !== 0) {
            throw new ReferenceException($this->response['message']);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function format()
    {
        $result = $this->response['content'];

        $country = strpos($this->response['address'], 'CN') !== false ? '中国' : '';

        return [
            'provider' => static::PROVIDER_NAME,
            'ip' => $this->ip,
            'postcode' => '',
            'country' => $country,
            'province' => $result['address_detail']['province'],
            'city' => $result['address_detail']['city'],
            'district' => $result['address_detail']['district'] ?: '',
            'implode' => ($country ? '中国' : '') . $result['address'],
            'location' => [
                'latitude' => $result['point']['y'],
                'longitude' => $result['point']['x'],
            ],
        ];
    }
}