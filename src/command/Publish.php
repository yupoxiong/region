<?php

namespace yupoxiong\region\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class Publish extends Command
{
    protected function configure()
    {
        $this->setName('region:publish')->setDescription('Publish Region');
    }

    protected function execute(Input $input, Output $output)
    {


        if (!file_exists(env('config_path').'region.php')) {
            copy(__DIR__.'/../../config/region.php', env('config_path').'region.php');
        }
    }
}
