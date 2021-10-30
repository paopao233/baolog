<?php
/**
 * Copyright 2021, https://github.com/paopao233
 * All right reserved.
 *
 * @author parklot
 * @date 2021-10月-29日 20:58
 * @description 页面函数
 * @license GPL v3 LICENSE
 */
//post请求函数
function do_post2($url, $data)
{
    $options = array(
        'http' => array(
            'method' => 'POST',
            'content' => $data
        ),
        );
    $result = file_get_contents($url, false, stream_context_create($options));
    return $result;
}

