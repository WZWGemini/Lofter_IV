<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
     '__rest__'=>[
        // 指向index模块的blog控制器
        'user'=>'api/user',
        'article'=>'api/article',
        'tag'=>'api/tag',
        'comment'=>'api/comment',
        'concern'=>'api/concern',
        'onearticle'=>'api/onearticle',
        'music'=>'api/music',
        'distag'=>'api/distag',
        'hot'=>'api/hot',
        'personal'=>'api/personal',
        'shop'=>'api/shop',
        'shopcar' => 'api/shopcar',
        'sgoods' => 'api/sgoods',
        'consigner' => 'api/consigner'
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
