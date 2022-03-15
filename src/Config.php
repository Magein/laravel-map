<?php

return [

    // 是否抛出异常
    'debug' => false,

    // 默认的配置
    'default' => [
        // 默认使用的平台
        'platform' => \Magein\Map\Lib\Platform\TencentMap::class,
        /**
         * 一般第三方平台会限制接口请求次数,可以采用多个keys的方式绕过
         * 1 指定 2 随机
         */
        'mode' => 1,
    ],

    /**
     * 腾讯的配置
     */
    'tencent' => [
        'keys' => [],
    ],

    /**
     * 百度的配置
     */
    'baidu' => [
        'keys' => [],
    ],

    /**
     * 高德的配置
     */
    'gaode' => [
        'keys' => [],
    ]
];
