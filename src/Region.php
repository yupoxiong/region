<?php
/**
 * @author yupoxiong<i@yufuping.com>
 * @date 2018/10/29
 */

namespace yupoxiong\region;

use yupoxiong\region\model\Regions;

class Region
{
    protected $region;

    public function __construct()
    {
        $this->region = new Regions();
    }

    public function getRegion($parent_id=0)
    {
        return $this->region->getRegion($parent_id);
    }

    public function getProvince($province_id=0)
    {
        return $this->region->getProvince($province_id);
    }

    public function getCity($parent_id=0)
    {
        return $this->region->getCity($parent_id);
    }

    public function getDistrict($parent_id=0)
    {
        return $this->region->getDistrict($parent_id);
    }

    public function getStreet($parent_id=0)
    {
        return $this->region->getStreet($parent_id);
    }

    public function searchRegion($keywords='jn')
    {
        return $this->region->searchRegion($keywords);
    }

    public function searchProvince($keywords='sd')
    {
        return $this->region->searchProvince($keywords);
    }

    public function searchCity($keywords='jn')
    {
        return $this->region->searchCity($keywords);
    }

    public function searchDistrict($keywords='lc')
    {
        return $this->region->searchDistrict($keywords);
    }

    public function searchStreet($keywords='bs')
    {
        return $this->region->searchStreet($keywords);
    }
}