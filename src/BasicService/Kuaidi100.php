<?php

namespace ExpressBox\BasicService;

interface Kuaidi100
{
    /**
     * @param string $trackingNumber
     * @return string
     */
    public function autonumber(string $trackingNumber): string;

    public function map();

    public function sms();

    public function subscribe();

    public function tracking(array $parameters): string;

    public function html();

    public function image();

    public function printer();

    public function cancel();

    public function code();

    public function order();

    public function querymkt();
}