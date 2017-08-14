<?php
// 创建资源路由目录
//本文件在application下  直接使用php think  build 即可
return [
    // 生成应用公共文件
    '__file__' => ['common.php', 'config.php', 'database.php'],

    // 定义demo模块的自动生成 （按照实际定义的文件名生成）
    'api'     => [
        '__file__'   => ['common.php'],
        '__dir__'    => ['controller', 'model'],
        'controller' => ['User', 'Article', 'Tag'],
        'model'      => ['User', 'Article','Tag']
    ],
    // 其他更多的模块定义
];
