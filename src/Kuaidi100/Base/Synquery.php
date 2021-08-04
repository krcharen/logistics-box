<?php

namespace ExpressBox\Kuaidi100\Base;

use ExpressBox\Exceptions\Exception;
use ExpressBox\Exceptions\InvalidArgument;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Synquery
{
    /**
     * @var string
     */
    private static $URL = 'http://poll.kuaidi100.com/poll/query.do';

    /**
     * @var string
     */
    private static $key;

    /**
     * @var string
     */
    private static $customer;

    /**
     * Synquery constructor.
     * @param string $key
     * @param string $customer
     * @throws InvalidArgument
     */
    public function __construct(string $key, string $customer)
    {
        if (empty($key) || empty($customer)) throw new InvalidArgument('无效的授权码。');
        self::$key = $key;
        self::$customer = $customer;
    }

    /**
     * @param array $parameters
     * @return mixed
     * @throws InvalidArgument
     */
    public static function getSynquery(array $parameters)
    {
        if (empty($parameters['com']) || empty($parameters['num'])) throw new InvalidArgument('缺少必要的参数。');

        $parameters['show'] = empty($parameters['show']) ? '0' : $parameters['show'];
        $params = json_encode($parameters, 448);
        $sign = strtoupper(md5($params . self::$key . self::$customer));

        $data = [
            'customer' => self::$customer,
            'sign' => $sign,
            'param' => $params,
        ];

        return self::http($data);
    }

    /**
     * @param array $data
     * @return string
     * @throws Exception
     */
    private static function http(array $data)
    {
        $http = new Client(['headers' => [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]]);

        try {
            $response = $http->post(self::$URL, [
                'form_params' => $data
            ]);

            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            throw new Exception($e->getResponse()->getBody()->getContents());
        }
    }
}