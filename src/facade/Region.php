<?php

namespace yupoxiong\region\facade;

use think\Facade;

/**
 * @see \yupoxiong\region\model\Region
 * @method array|\PDOStatement|string|\think\Collection getRegion($parent_id = 0) static 获取地区
 * @method array|\PDOStatement|string|\think\Collection getProvince() static 获取地区
 * @method array|\PDOStatement|string|\think\Collection getCity($parent_id) static 获取地区
 * @method array|\PDOStatement|string|\think\Collection getDistrict($parent_id) static 获取地区
 * @method array|\PDOStatement|string|\think\Collection getStreet($parent_id) static 获取地区
 * @method array|\PDOStatement|string|\think\Collection searchRegion($keywords, $parent_id = 0) static 获取地区
 * @method array|\PDOStatement|string|\think\Collection searchProvince($keywords) static 获取地区
 * @method array|\PDOStatement|string|\think\Collection searchCity($keywords, $parent_id = 0) static 获取地区
 * @method array|\PDOStatement|string|\think\Collection searchDistrict($keywords, $parent_id = 0) static 获取地区
 * @method array|\PDOStatement|string|\think\Collection searchStreet($keywords, $parent_id = 0) static 获取地区
 */
class Region extends Facade
{
    protected static function getFacadeClass()
    {
        return '\yupoxiong\region\model\Region';
    }
}
