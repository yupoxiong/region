<?php
/**
 * region配置
 */

return [
    //查询缓存秒数，false为不缓存
    'cache' => 20140210,
    //查询字段，可选项：id,name,parent_id,initial,pinyin,citycode,adcode,lng_lat
    'field' => 'id,name',
    //排序，默认为adcode正序
    'order' => 'adcode asc',
];