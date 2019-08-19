<?php

namespace \yupoxiong\region\facade;

use think\Facade;

class Region extends Facade
{
    protected static function getFacadeClass()
    {

        return '\yupoxiong\region\model\Region';
    }
}
