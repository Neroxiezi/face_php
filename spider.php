<?php
/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2018/7/13
 * Time: 14:16
 *
 *
 *                      _ooOoo_
 *                     o8888888o
 *                     88" . "88
 *                     (| ^_^ |)
 *                     O\  =  /O
 *                  ____/`---'\____
 *                .'  \\|     |//  `.
 *               /  \\|||  :  |||//  \
 *              /  _||||| -:- |||||-  \
 *              |   | \\\  -  /// |   |
 *              | \_|  ''\---/''  |   |
 *              \  .-\__  `-`  ___/-. /
 *            ___`. .'  /--.--\  `. . ___
 *          ."" '<  `.___\_<|>_/___.'  >'"".
 *        | | :  `- \`.;`\ _ /`;.`/ - ` : | |
 *        \  \ `-.   \_ __\ /__ _/   .-` /  /
 *  ========`-.____`-.___\_____/___.-`____.-'========
 *                       `=---='
 *  ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 *           佛祖保佑       永无BUG     永不修改
 *
 */

use Curl\Curl;

require './vendor/autoload.php';
$key_words = ['性感美女'];

$spider_url = [
    'baidu' => 'https://image.baidu.com/search/index?tn=baiduimage&word=',
];

//爬取
function get_picture($obj,$key_words,$spider_url,$params=[])
{
    $url = $spider_url[$obj].$key_words;
    $curl = new Curl();
    $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
    $curl->get($url);
    echo $curl->response;

}

foreach ($key_words as $key_word) {
    for($i=0;$i<=1;$i++) {
        get_picture('baidu',$key_word,$spider_url,['p'=>$i]);
    }

}