<?php

namespace yupoxiong\region\command;

use think\migration\command\migrate\Run as MigrateRun;
use Db;

class Migrate extends MigrateRun
{
    protected function configure()
    {
        parent::configure();
        $this->setName('region:migrate')->setDescription('Migrate the database for Region');
    }

    protected function getPath()
    {
        return __DIR__.'/../../database/migrations';
    }


}
