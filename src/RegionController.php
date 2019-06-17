<?php
/**
 * Region控制器
 * @author yupoxiong<i@yufuping.com>
 * @date 2018/10/29
 */

namespace yupoxiong\region;

use yupoxiong\region\model\Region;

class RegionController
{
    protected $region;

    public function __construct()
    {
        $this->region = new Region();
    }

    public function getRegion($parent_id = 0)
    {
        return json($this->region->getRegion($parent_id));
    }

    public function getProvince()
    {
        return json($this->region->getProvince());
    }

    public function getCity($parent_id = 0)
    {
        return json($this->region->getCity($parent_id));
    }

    public function getDistrict($parent_id = 0)
    {
        return json($this->region->getDistrict($parent_id));
    }

    public function getStreet($parent_id = 0)
    {
        return json($this->region->getStreet($parent_id));
    }

    public function searchRegion($keywords = 'jn', $parent_id)
    {
        return json($this->region->searchRegion($keywords, $parent_id));
    }

    public function searchProvince($keywords = 'sd')
    {
        return json($this->region->searchProvince($keywords));
    }

    public function searchCity($keywords = 'jn', $parent_id)
    {
        return json($this->region->searchCity($keywords, $parent_id));
    }

    public function searchDistrict($keywords = 'lc', $parent_id)
    {
        return json($this->region->searchDistrict($keywords, $parent_id));
    }

    public function searchStreet($keywords = 'bs', $parent_id)
    {
        return json($this->region->searchStreet($keywords, $parent_id));
    }
}