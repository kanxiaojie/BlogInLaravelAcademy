<?php
/**
 * Created by PhpStorm.
 * User: kxj
 * Date: 16-3-3
 * Time: 下午2:02
 */
return[
    'name' => 'Laravel 学院',
    'title' => 'My Blog',
    'subtitle' => 'http://laravelacademy.org',
    'description' => 'Laravel学院致力于提供优质Laravel中文学习资源',
    'author' => '学员君',
    'page_image' => 'home-bg.jpg',
    'posts_per_page' => 10,
    'uploads' => [
       'storage' => 'local',//定义使用的系统文件
        'webpath' => '/uploads/',//定义WEB访问根目录
    ] ,
];