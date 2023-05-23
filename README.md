# ThinkPHP省市区(县)街道四级联动扩展

[![](https://img.shields.io/badge/php->=5.6-blue.svg)](https://github.com/yupoxiong/region)


> 支持 `TP5.0.*` 和 `TP5.1.*` 还有 `TP6.0` ，搜索功能支持汉字，支持拼音，首字母搜索。

#### 安装

##### 第一步：安装扩展
Composer 运行扩展安装命令
```
# TP数据库迁移工具
composer require topthink/think-migration
# 本扩展
composer require yupoxiong/region
```

##### 第二步：创建数据表
复制`vendor/yupoxiong/region/database/migrations`目录下的数据库迁移文件到TP迁移目录(一般是 `/database/migrations/` )，然后运行TP自带迁移命令创建表。
> TP5.1 版本可以直接运行以下两个命令完成安装
```
php think region:publish

php think region:migrate
```
> TP6.0 版本可以直接运行以下命令完成安装
```
php think region:migrate
```

#### 添加路由
TP5.0 在 `/application/route.php` 中追加，TP5.1 在 `/route/route.php` 中追加。

```
Route::alias('region','\yupoxiong\region\RegionController');
```
> TP6.0版本已经去掉别名路由，可以在路由配置里添加以下路由(多应用模式在应用路由里添加)：
```php
Route::group('region',function (){
    Route::any('getRegion','\yupoxiong\region\RegionController@getRegion');
    Route::any('getProvince','\yupoxiong\region\RegionController@getProvince');
    Route::any('getCity','\yupoxiong\region\RegionController@getCity');
    Route::any('getDistrict','\yupoxiong\region\RegionController@getDistrict');
    Route::any('getStreet','\yupoxiong\region\RegionController@getStreet');
    Route::any('searchRegion','\yupoxiong\region\RegionController@searchRegion');
    Route::any('searchProvince','\yupoxiong\region\RegionController@searchProvince');
    Route::any('searchCity','\yupoxiong\region\RegionController@searchCity');
    Route::any('searchDistrict','\yupoxiong\region\RegionController@searchDistrict');
    Route::any('searchStreet','\yupoxiong\region\RegionController@searchStreet');
});
```

#### 使用

##### 获取地区(最常用的方式)
 * url `/region/getRegion`
 * 参数 parent_id ，可不传(默认0)获取省份，传入上级 id 即可获取该 id 对应的下级

##### 获取省
 * url `/region/getProvince`
 * 参数 无
 
##### 获取市
 * url `/region/getCity`
 * 参数 parent_id ，传入所属省 id 即可获取该省下面的市

##### 获取区
 * url `/region/getDistrict`
 * 参数 parent_id ，传入所属市 id 即可获取该市下面的区(县)
 
##### 获取街道
 * url `/region/getStreet`
 * 参数 parent_id ，传入所属区(县) id 即可获取该市下面的街道

##### 搜索地区
 * url `/region/searchRegion`
 * 参数 keywords ，搜索地区的关键字
 * 参数 parent_id ，搜索地区的父级 id ，默认0为搜索省份
 
##### 搜索省
 * url `/region/searchProvince`
 * 参数 keywords ，搜索地区的关键字

##### 搜索市
 * url `/region/searchCity`
 * 参数 keywords ，搜索地区的关键字
 * 参数 parent_id ，所属省 id

##### 搜索区
 * url `/region/searchDistrict`
 * 参数 keywords ，搜索地区的关键字
 * 参数 parent_id ，所属市 id
 
##### 搜索街道
 * url `/region/searchStreet`
 * 参数 keywords ，搜索街道的关键字
 * 参数 parent_id ，所属区(县) id
 
#### 可选配置
可在配置文件中添加以下配置，5.0.* 在 `/application/config.php` 中追加。

```php
//获取省市区街道缓存、查询字段配置
'region' => [
    //查询缓存秒数，false为不缓存
    'cache' => 20140210,
    //查询字段，可选项：id,name,parent_id,initial,pinyin,citycode,adcode,lng_lat
    'field' => 'id,name',
    //排序，默认为adcode正序
    'order' => 'adcode asc',
]
    
```
> 5.1.* 和 6.0 直接运行以下命令即可在 config 目录下生成 `region.php` 配置文件。
```
php think region:publish
```

#### Facade

TP5.1 和 TP6.0 可以在开发中直接使用以下代码获取数据：
```php
\yupoxiong\region\facade\Region::getProvince();
//更多可参考该类
```

#### 测试相关
安装配置好之后可以将`vendor/yupoxiong/region/tests/region.html`放到项目`public`目录下访问测试扩展是否可用

 [点此查看demo](https://demo.bearadmin.com/region.html)