<?php

namespace ExpressBox\Kuaidi100\Base;

use ExpressBox\Exceptions\Exception;
use ExpressBox\Exceptions\InvalidArgument;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Autonumber
{
    /**
     * @var string 
     */
    private static $URL = 'http://www.kuaidi100.com/autonumber/auto';

    /**
     * @var string
     */
    private static $key;

    /**
     * Autonumber constructor.
     * @param string $key
     * @param string $customer
     * @throws InvalidArgument
     */
    public function __construct(string $key, string $customer = '')
    {
        if (empty($key)) throw new InvalidArgument("无效的授权码。");
        self::$key = $key;
    }

    /**
     * @param string $trackingNumber
     * @return string
     * @throws Exception
     * @throws InvalidArgument
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getAutonumber(string $trackingNumber)
    {
        if (empty($trackingNumber)) throw new InvalidArgument("无效的快递单号。");
        return self::http($trackingNumber);
    }

    /**
     * @param string $data
     * @return string
     * @throws Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private static function http(string $data)
    {
        $http = new Client(['headers' => [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]]);

        try {
            $response = $http->request('GET', self::$URL, [
                'query' => [
                    'num' => $data,
                    'key' => self::$key
                ]
            ]);

            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            throw new Exception($e->getResponse()->getBody()->getContents());
        }
    }
}