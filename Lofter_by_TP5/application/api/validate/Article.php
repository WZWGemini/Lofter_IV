<?php

namespace app\api\Validate;
use think\Validate;

class Article extends Validate{

    protected $rule = [
        'article_content'=> "require"
    ];

    protected $message = [
        'article_content.require'=>"文章内容不能为空"
    ];

}

?>