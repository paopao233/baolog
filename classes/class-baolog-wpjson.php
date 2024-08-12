<?php

class Baolog_JsonData
{

    public static function jsondata_init()
    {
        // 获取文章信息
        register_rest_route('balogv1', '/douyin', [
            'methods' => 'GET',
            'callback' => [__CLASS__, 'get_douyin_no_remark'],
            'permission_callback' => '__return_true',
        ]);
    }

    public static function get_douyin_no_remark($request)
    {
        // 获取 URL 参数
        $url = $request->get_param('url');
        $url = self::getCurl($url);  // 使用 self:: 而不是 $this

        preg_match('/video\/([0-9]+)\//i', $url, $matches);

        return self::douyin($matches[1]);
    }


    /**
     * 发起请求
     */
    public static function getCurl($url, $options = [], $foll = 0)  // 需要将方法改为静态方法
    {
        //初始化
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); //访问的url
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //完全静默
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //忽略https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //忽略https
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge([self::getRandomUserAgent()], $options)); //UA
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $foll); //默认为$foll=0,大概意思就是对照模块网页访问的禁止301 302 跳转。
        $output = curl_exec($ch); //获取内容
        curl_close($ch); //关闭
        return $output; //返回
    }

    public static function douyin($id)
    {
        // 检查 ID 是否有效
        if (empty($id)) {
            return array('code' => 400, 'msg' => '无法解析视频 ID');
        }

        // 构造请求头
        $header = array(
            'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1 Edg/122.0.0.0'
        );

        // 发送请求获取视频信息

        $response = self::getCurl('https://www.iesdouyin.com/share/video/' . $id, $header);
        // 匹配视频信息的正则表达式
        $pattern = '/window\._ROUTER_DATA\s*=\s*(.*?)\<\/script>/s';
        preg_match($pattern, $response, $matches);
        if (empty($matches[1])) {
            return array('code' => 201, 'msg' => '解析失败');
        }

        $videoInfo = json_decode(trim($matches[1]), true);
        if (!isset($videoInfo['loaderData'])) {
            return array('code' => 201, 'msg' => '解析失败');
        }

        $id = "(id)";
        $videoResUrl = str_replace('playwm', 'play', $videoInfo['loaderData']['video_' . $id . '/page']['videoInfoRes']['item_list'][0]['video']['play_addr']['url_list'][0]);

        // 构造返回数据
        $arr = array(
            'code' => 200,
            'msg' => '解析成功',
            'data' => array(
                'author' => $videoInfo['loaderData']['video_' . $id . '/page']['videoInfoRes']['item_list'][0]['author']['nickname'],
                'uid' => $videoInfo['loaderData']['video_' . $id . '/page']['videoInfoRes']['item_list'][0]['author']['unique_id'],
                'avatar' => $videoInfo['loaderData']['video_' . $id . '/page']['videoInfoRes']['item_list'][0]['author']['avatar_medium']['url_list'][0],
                'like' => $videoInfo['loaderData']['video_' . $id . '/page']['videoInfoRes']['item_list'][0]['statistics']['digg_count'],
                'time' => $videoInfo['loaderData']['video_' . $id . '/page']['videoInfoRes']['item_list'][0]['create_time'],
                'title' => $videoInfo['loaderData']['video_' . $id . '/page']['videoInfoRes']['item_list'][0]['desc'],
                'cover' => $videoInfo['loaderData']['video_' . $id . '/page']['videoInfoRes']['item_list'][0]['video']['cover']['url_list'][0],
                'url' => $videoResUrl,
                'music' => array(
                    'author' => $videoInfo['loaderData']['video_' . $id . '/page']['videoInfoRes']['item_list'][0]['music']['author'],
                    'avatar' => $videoInfo['loaderData']['video_' . $id . '/page']['videoInfoRes']['item_list'][0]['music']['cover_large']['url_list'][0]
                )
            )
        );

        return $arr;
    }

    private static function getRandomUserAgent()
    {
        return 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36';
    }
}
