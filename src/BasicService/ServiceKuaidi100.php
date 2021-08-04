<?php

namespace ExpressBox\BasicService;

use ExpressBox\Exceptions\Exception;
use ExpressBox\Kuaidi100\Base\Autonumber;
use ExpressBox\Kuaidi100\Base\Synquery;

class ServiceKuaidi100 implements Kuaidi100
{
    /**
     * @var mixed|null
     */
    private $key;

    /**
     * @var mixed|null
     */
    private $customer;

    /**
     * ServiceKuaidi100 constructor.
     * @param array $config
     * @throws Exception
     */
    public function __construct(array $config = [])
    {
        if (!count($config)) throw new Exception('缺少必要的参数。');
        $this->key = $config['key'] ?? '';
        $this->customer = $config['customer'] ?? '';
    }

    /**
     * 快递智能识别单号
     * @param string $trackingNumber
     * @return string
     * @throws Exception
     * @throws \ExpressBox\Exceptions\InvalidArgument
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function autonumber(string $trackingNumber): string
    {
        $_ = new Autonumber($this->key);
        return $_::getAutonumber($trackingNumber);
    }

    //地图轨迹
    public function map()
    {

    }

    //短信请求
    public function sms()
    {
        // TODO : Implement sms() method.
    }

    //订阅请求
    public function subscribe()
    {
        // TODO: Implement subscribe() method.
    }

    /**
     * 实时快递查询
     * @param array $parameters
     * @return string
     * @throws \ExpressBox\Exceptions\InvalidArgument
     */
    public function tracking(array $parameters): string
    {
        $_ = new Synquery($this->key, $this->customer);
        return $_::getSynquery($parameters);
    }

    //电子面单返回html内容
    public function html()
    {
        // TODO: Implement html() method.
    }

    //电子面单返回图片
    public function image()
    {
        // TODO: Implement image() method.
    }

    //电子面单打印
    public function printer()
    {
        // TODO: Implement printer() method.
    }

    //商家寄件取消
    public function cancel()
    {
        // TODO: Implement cancel() method.
    }

    //商家寄件获取取件码
    public function code()
    {
        // TODO: Implement code() method.
    }

    //商家寄件下单
    public function order()
    {
        // TODO: Implement order() method.
    }

    //商家寄件获取运力
    public function querymkt()
    {
        // TODO: Implement querymkt() method.
    }
}