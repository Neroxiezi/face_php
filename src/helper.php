<?php
/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2018/7/13
 * Time: 10:37
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

if (!function_exists('dd')) {
    function dd($arr)
    {
        echo '<pre>';
        var_dump($arr);
        echo '</pre>';
        exit;
    }
}

if (!function_exists('json')) {
    function json($code, $messages, $data=[])
    {
        if ($code == 200) {
            return json_encode(['code'=>$code,'data'=>$data,'messages'=>$messages]);
        } else {
            return json_encode(['code'=>$code,'messages'=>$messages]);
        }
    }
}