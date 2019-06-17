<?php
/**
 * TestCase
 * @author yupoxiong<i@yufuping.com>
 * @date 2018/11/1
 */

require_once '../vendor/autoload.php';

use yupoxiong\region\RegionController;

$region = new RegionController();
$result = $region->getRegion();

var_dump($result);