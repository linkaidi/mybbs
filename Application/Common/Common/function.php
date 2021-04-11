<?php

/*
    功能：传入大图文件名，得到一个缩率图文件名
    参数：大图文件名
    返回值：缩率图文件名
*/

function getSm($filename)
{   
    $arr = explode('/',$filename);
    $arr[3] = 'sm_'.$arr[3];
    return implode('/',$arr);
}