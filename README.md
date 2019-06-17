# ThinkPHP省市区(县)街道四级联动扩展

[![](https://img.shields.io/badge/php->=5.6-blue.svg)](https://github.com/yupoxiong/region)


> 支持TP5.0.*和TP5.1.*，搜索功能支持汉字，支持拼音，首字母搜索。

#### 安装

##### 第一步：安装扩展
composer运行扩展安装命令
```
composer require yupoxiong/region
```

##### 第二步：创建数据表
复制`vendor/yupoxiong/region/src/migrations`目录下的数据库迁移文件到TP迁移目录(一般是/database/migrations/)，然后运行TP自带迁移命令创建表。


#### 添加路由
TP5.0在`/application/route.php`中追加，TP5.1在`/route/route.php`中追加。

```
Route::alias('region','\yupoxiong\region\RegionController');
```

#### 使用

##### 获取地区(最常用的方式)
 * url `/region/getRegion`
 * 参数 parent_id，可不传(默认0)获取省份，传入上级id即可获取该id对应的下级

##### 获取省
 * url `/region/getProvince`
 * 参数 无
 
##### 获取市
 * url `/region/getCity`
 * 参数 parent_id，传入所属省id即可获取该省下面的市

##### 获取区
 * url `/region/getDistrict`
 * 参数 parent_id，传入所属市id即可获取该市下面的区(县)
 
##### 获取街道
 * url `/region/getStreet`
 * 参数 parent_id，传入所属区(县)id即可获取该市下面的街道

##### 搜索地区
 * url `/region/searchRegion`
 * 参数 keywords，搜索地区的关键字
 * 参数 parent_id，搜索地区的父级id，默认0为搜索省份
 
##### 搜索省
 * url `/region/searchProvince`
 * 参数 keywords，搜索地区的关键字

##### 搜索市
 * url `/region/searchCity`
 * 参数 keywords，搜索地区的关键字
 * 参数 parent_id，所属省id

##### 搜索区
 * url `/region/searchDistrict`
 * 参数 keywords，搜索地区的关键字
 * 参数 parent_id，所属市id
 
##### 搜索街道
 * url `/region/searchStreet`
 * 参数 keywords，搜索街道的关键字
 * 参数 parent_id，所属区(县)id
 
#### 可选配置
可在配置文件中添加以下配置，5.0.*在`/application/config.php`中追加，5.1.*在`/config/app.php`中追加

```
//获取省市区街道缓存、查询字段配置
'region' => [
    //查询缓存秒数，false为不缓存
    'cache' => 20140210,
    //查询字段，可选项：id,name,code,parent_id,initial,pingyin,citycode,adcode,lng_lat
    'field' => 'id,name',
    //排序，默认为adcode正序
    'order' => 'adcode asc'
]
```

#### 测试相关
安装配置好之后可以将`vendor/yupoxiong/region/tests/region.html`放到项目`public`目录下访问测试扩展是否可用

 [点此查看demo](https://bearadmin.yufuping.com/region.html)