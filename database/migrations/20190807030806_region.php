<?php
/**
 * 省市区表迁移文件
 */

use think\migration\Migrator;
use think\migration\db\Column;

class Region extends Migrator
{
    /**
     * 创建表并插入数据
     */
    public function change()
    {
        $region = $this->table('region', ['comment' => '省市区', 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $region->addColumn('parent_id', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '父级'])
            ->addColumn('level', 'boolean', ['limit' => 1, 'default' => 1, 'comment' => '等级'])
            ->addColumn('name', 'string', ['limit' => 50, 'default' => '', 'comment' => '名称'])
            ->addColumn('initial', 'string', ['limit' => 50, 'default' => '', 'comment' => '首字母'])
            ->addColumn('pinyin', 'string', ['limit' => 255, 'default' => '', 'comment' => '拼音'])
            ->addColumn('citycode', 'string', ['limit' => 10, 'default' => '', 'comment' => '城市编码'])
            ->addColumn('adcode', 'string', ['limit' => 10, 'default' => '', 'comment' => '区域编码'])
            ->addColumn('lng_lat', 'string', ['limit' => 30, 'default' => '', 'comment' => '中心经纬度'])
            ->addIndex(['name'], ['name' => 'index_name'])
            ->addIndex(['initial'], ['name' => 'index_initial'])
            ->addIndex(['pinyin'], ['name' => 'index_pinyin'])
            ->addIndex(['name', 'initial', 'pinyin'], ['name' => 'index_name_initial_pinyin'])
            ->create();
        $this->insertData();

    }

    /**
     * 插入数据
     */
    public function insertData()
    {

        //兼容TP5.0
        if (defined('THINK_VERSION')) {
            $is_tp6       = false;
            $runtime_path = RUNTIME_PATH;
        } else {
            $is_tp6       = strpos(\think\App::VERSION, '6.0') !== false;
            $runtime_path = app()->getRuntimePath();
        }


        print ('正在下载json数据压缩包···' . "\n");
        $online_zip = file_get_contents('http://json.think-region.yupoxiong.com/region.json.zip?v=' . uniqid('region', true));
        $zip_file   = $runtime_path . 'region.json.zip';
        $json_file  = $runtime_path . 'region.json';
        file_put_contents($zip_file, $online_zip);

        print ('正在解压json数据压缩包···' . "\n");
        $zipArc = new ZipArchive();
        $zipArc->open($zip_file);
        $zipArc->extractTo($runtime_path);
        $zipArc->close();

        print ('正在读取json数据···' . "\n");
        $json  = file_get_contents($json_file);
        $data  = json_decode($json, true);
        $msg   = "\n" . '数据导入成功';
        $total = count($data) + 1;

        print ('正在导入数据···' . "\n");

        //判断TP5/TP6
        if (!$is_tp6) {
            print ('tp5');
            \think\Db::startTrans();
        } else {
            print ('tp6');
            \think\facade\Db::startTrans();
        }

        try {
            foreach ($data as $key => $value) {
                \yupoxiong\region\model\Region::create($value);
                $this->showStatus($key + 1, $total, 10);
            }

            //判断TP5/TP6
            if (!$is_tp6) {
                \think\Db::commit();
            } else {
                \think\facade\Db::commit();
            }

        } catch (\Exception $e) {

            //判断TP5/TP6
            if (!$is_tp6) {
                \think\Db::rollback();
            } else {
                \think\facade\Db::rollback();
            }

            $msg = $e->getMessage();
        }
        print ($msg . "\n");
        unset($total);
        unset($data);
        unset($json);
        unlink($zip_file);
        unlink($json_file);
    }

    /**
     * 显示进度
     * @param $done
     * @param $total
     * @param int $size
     */
    protected function showStatus($done, $total, $size = 20)
    {
        static $start_time;
        if ($done > $total) return;
        if (empty($start_time)) $start_time = time();
        $now        = time();
        $percent    = (double)($done / $total);
        $bar        = floor($percent * $size);
        $status_bar = "\r[";
        $status_bar .= str_repeat('=', $bar);
        if ($bar < $size) {
            $status_bar .= '>';
            $status_bar .= str_repeat(' ', $size - $bar);
        } else {
            $status_bar .= '=';
        }
        $display    = number_format($percent * 100, 0);
        $status_bar .= "] $display%  $done/$total";
        $rate       = ($now - $start_time) / $done;
        $left       = $total - $done;
        $eta        = round($rate * $left, 2);
        $elapsed    = $now - $start_time;
        $status_bar .= ' 预计剩余: ' . number_format($eta) . ' 秒. 已执行: ' . number_format($elapsed) . ' 秒.';
        echo "$status_bar  ";
        flush();
        if ($done === $total) {
            echo "\n";
        }
    }

}
