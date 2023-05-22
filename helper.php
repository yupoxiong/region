<?php

if ('cli' === PHP_SAPI || 'phpdbg' === PHP_SAPI) {
    //兼容TP5.0
    if(!defined('THINK_VERSION')){
        if (strpos(\think\App::VERSION, '5.1') === 0) {
            \think\Console::addDefaultCommands([
                'region:publish' => \yupoxiong\region\command\Publish::class,
                'region:migrate' => \yupoxiong\region\command\Migrate::class,
            ]);
        }
    }
}
