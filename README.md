# ThinkPHP省市区(县)街道四级联动扩展

#### 安装

##### 第一步：安装扩展
composer运行扩展安装命令
```
composer require yupoxiong/region
```

##### 第二步：创建数据表
* 方法一：用数据库工具将regions.sql(编码utf8mb4)导入到您的数据库，并修改表前缀。
* 方法二：复制src/migrations目录下的数据库迁移文件到TP迁移目录(一般是/database/migrations/)，将regions.json复制到项目根目录，运行TP自带迁移命令创建表


#### 添加路由
TP5.0在`/application/route.php`中追加，TP5.1在`/route/route.php`中追加

```
Route::alias('region','\yupoxiong\region\Region');
```

#### 使用

##### 获取地区(最常用的方式)
 * url `/region/getRegion`
 * 参数 parent_id，可不传(默认0)获取省份，传入上级id即可获取该id对应的下级

##### 获取省
 * url `/region/getProvince`
 * 参数 province_id，不传默认获取全部省份，传入省份id获取该省份信息
 
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
 * 参数 keywords，搜索地区的关键字，支持汉字，支持拼音，首字母
 * 参数 parent_id，搜索地区的父级，默认0为搜索省份
 
##### 搜索省
 * url `/region/getProvince`
 * 参数 province_id，不传默认获取全部省份，传入省份id获取该省份信息

##### 搜索市
 * url `/region/getCity`
 * 参数 parent_id，传入所属省id即可获取该省下面的市

##### 搜索区
 * url `/region/getDistrict`
 * 参数 parent_id，传入所属市id即可获取该市下面的区(县)
 
##### 搜索街道
 * url `/region/getStreet`
 * 参数 parent_id，传入所属区(县)id即可获取该市下面的街道
 
#### 可选配置
可在配置文件中添加以下配置，5.0.*在`/application/config.php`中追加，5.1.*在`/config/app.php`中追加

```
//获取省市区街道缓存、查询字段配置
'region' => [
    //查询缓存秒数，false为不缓存
    'cache' => 20140210,
    //查询字段，可选项：id,name,code,parent_id,initial,pingyin
    'field' => 'id,name',
]
```
