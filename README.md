<h1 align="center"> easyip </h1>

<p align="center"> .</p>


## Installing

```shell
$ composer require shiran/easyip -vvv
```

## Usage

```php
$config = [
    'provider' => 'tencent',
    'tencent' => [
        'key' => '',
    ],
    
    ...
    ...
    ...
];

$ip = new \Shiran\EasyIp\EasyIp($config);

$result = $ip->parse('');
```

### 在 Laravel 中使用

```bash
php artisan vendor:publish --provider="Shiran\EasyIp\ServiceProvider"
```

进入 config/easyip.php
```php
return [
    'provider' => '',


    'tencent' => [
        'key' => '',
    ],
    
    ...
    ...
    ...
]
```

在 tinker 中测试
```bash
app('EasyIp')->parse('')

...
...
```

数据返回格式
```
[
     "provider" => "Tencent",
     "ip" => "119.123.73.19",
     "postcode" => 440306,
     "country" => "中国",
     "province" => "广东省",
     "city" => "深圳市",
     "district" => "宝安区",
     "implode" => "中国广东省深圳市宝安区",
     "location" => [
       "latitude" => 22.55329,
       "longitude" => 113.88308,
     ],
]
```

## License

MIT
