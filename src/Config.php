<?php

return [

    // 调试模式
    'debug' => false,

    // 日志
    'logs' => [
        // 路径
        'path' => '',
        // 1 调试模式 2 全纪录
        'mode' => 1,
    ],

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