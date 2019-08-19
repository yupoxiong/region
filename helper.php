<?php

if ('cli' === PHP_SAPI || 'phpdbg' === PHP_SAPI) {

    if (strpos(\think\App::VERSION, '6.0') === false) {
        \think\Console::addDefaultCommands([
            'region:publish' => \yupoxiong\region\command\Publish::class,
            'region:migrate' => \yupoxiong\region\command\Migrate::class,
        ]);
    }
}
