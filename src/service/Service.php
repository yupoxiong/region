<?php


namespace yupoxiong\region\service;

use yupoxiong\region\command\Publish;
use yupoxiong\region\command\Migrate;

class Service extends \think\Service
{
    public function boot()
    {
        $this->commands(Publish::class);
        $this->commands(Migrate::class);
    }
}
