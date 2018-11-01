<?php

use think\Db;
use think\migration\Migrator;
use think\migration\db\Column;
use yupoxiong\region\model\Regions;

class CreateRegionsTable extends Migrator
{
    /**
     * 创建表并插入数据
     */
    public function change()
    {
        $region = $this->table('regions', ['engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $region->addColumn('name', 'string', ['limit' => 210, 'default' => '', 'comment' => '名称'])
            ->addColumn('code', 'string', ['limit' => 10, 'default' => '', 'comment' => '代码'])
            ->addColumn('level', 'boolean', ['limit' => 1, 'default' => 1, 'comment' => '等级'])
            ->addColumn('parent_id', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '父级ID'])
            ->addColumn('initial', 'string', ['limit' => 50, 'default' => '', 'comment' => '首字母'])
            ->addColumn('pinyin', 'string', ['limit' => 255, 'default' => '', 'comment' => '拼音'])
            ->addIndex(['name'], ['name' => 'index_name'])
            ->addIndex(['initial'], ['name' => 'index_initial'])
            ->addIndex(['pinyin'], ['name' => 'index_pinyin'])
            ->addIndex(['name', 'initial', 'pinyin'], ['name' => 'index_name_initial_pinyin'])
            ->create();
        $this->insertData();
    }


    public function insertData()
    {
        $json  = file_get_contents(__DIR__ . '/../../regions.json');
        $array = json_decode($json, true);
        $data  = $array['data'];
        $msg   = 'Insert data success';
        Db::startTrans();
        try {
            foreach ($data as $item) {
                Regions::create($item);
            }
            Db::commit();
        } catch (\Exception $e) {
            Db::rollback();
            $msg = $e->getMessage();
        }
        print ($msg . "\n");
    }
}
