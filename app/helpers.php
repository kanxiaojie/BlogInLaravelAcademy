<?php

/**
 * 返回刻可读性更好的尺寸
 * @param $bytes
 * @param int $decimals
 * @return string
 */
function human_filesize($bytes, $decimals = 2){
    $size = ['B', 'kb', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1)/3);

//    return sprintf("%.{$decimals}f", $bytes/pow(1024, $factor)).@size[$factor];
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .@$size[$factor];
}


/**
 * 判断文件MIME类型是否为图片
 * @param $mimeType
 * @return bool
 */
function is_image($mimeType){
    return starts_with($mimeType, 'image/');
}

/**
 * Return "checked" if true
 * @param $value
 * @return string
 */
function checked($value){
    return $value?'checked' : '';
}

function page_image($value = null)
{
    if(empty($value)){
        $value = config('blog.page_image');
    }
    if(!starts_with($value, 'http') && $value[0] !=='/'){
        $value = config('blog.uploads.webpath').'/'.$value;
    }

    return $value;
}















