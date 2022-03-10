<?php

return [

    'default' => [
        // 默认使用的平台
        'platform' => \Magein\Map\Lib\Platform\TencentPlatform::class,

        /**
         * 一般第三方平台会限制接口请求次数，keys可以采用多个的方式绕过
         *
         * 1 指定
         * 2 随机
         */
        'key_mode' => 1
    ],

    /**
     * 腾讯的配置
     */
    'tencent' => [
        'keys' => [],
    ],

    'baidu' => [
        'keys' => [],
    ],

    'gaode' => [
        'keys' => [],
    ]
];
