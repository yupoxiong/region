<?php
/**
 * @author yupoxiong<i@yufuping.com>
 * @date 2018/10/29
 */

namespace yupoxiong\region\model;

use think\Model;

class Regions extends Model
{
    protected $name = 'regions';

    protected $config = [
        'cache' => 20140210,
        'field' => 'id,name',
    ];

    public function __construct($data = [])
    {
        parent::__construct($data);
        $config = config('region');
        if ($config) {
            if (!isset($config['cache']) || !isset($config['field'])) {
                throw new \Exception('配置不完整');
            }
            $this->config = $config;
        }
    }

    /**
     * 获取地区
     * @param int $parent_id
     * @return array|\PDOStatement|string|\think\Collection
     */
    public function getRegion($parent_id = 0)
    {
        return $this
            ->where('parent_id', $parent_id)
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->select();
    }


    public function getProvince()
    {
        return $this
            ->where('level', 1)
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->select();
    }


    public function getCity($parent_id)
    {
        return $this
            ->where('parent_id', $parent_id)
            ->where('level', 2)
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->select();
    }


    public function getDistrict($parent_id)
    {
        return $this
            ->where('parent_id', $parent_id)
            ->where('level', 3)
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->select();
    }


    public function getStreet($parent_id)
    {
        return $this
            ->where('parent_id', $parent_id)
            ->where('level', 4)
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->select();
    }


    public function searchRegion($keywords, $parent_id = 0)
    {
        return $this
            ->where('parent_id', $parent_id)
            ->whereLike('name|initial|pinyin', '%' . $keywords . '%')
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->select();
    }


    public function searchProvince($keywords)
    {
        return $this
            ->where('level', 1)
            ->whereLike('name|initial|pinyin', '%' . $keywords . '%')
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->select();
    }


    public function searchCity($keywords, $parent_id = 0)
    {
        return $this
            ->where('level', 2)
            ->where('parent_id', $parent_id)
            ->whereLike('name|initial|pinyin', '%' . $keywords . '%')
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->select();
    }


    public function searchDistrict($keywords, $parent_id = 0)
    {
        return $this
            ->where('level', 3)
            ->where('parent_id', $parent_id)
            ->whereLike('name|initial|pinyin', '%' . $keywords . '%')
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->select();
    }


    public function searchStreet($keywords, $parent_id = 0)
    {
        return $this
            ->where('level', 4)
            ->where('parent_id', $parent_id)
            ->whereLike('name|initial|pinyin', '%' . $keywords . '%')
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->select();
    }

}