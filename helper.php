<?php

if ('cli' === PHP_SAPI || 'phpdbg' === PHP_SAPI) {
    \think\Console::addDefaultCommands([
        'region:publish' => \yupoxiong\region\command\Publish::class,
        'region:migrate' => \yupoxiong\region\command\Migrate::class,
    ]);
}

\think\Loader::addClassAlias([
    'Region' => \yupoxiong\region\facade\Casbin::class,
]);
