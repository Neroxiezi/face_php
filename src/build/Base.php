<?php
/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2018/7/12
 * Time: 16:58
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

namespace pf\face\build;


use Curl\Curl;

class Base
{
    protected $config;
    protected $api_url;
    protected $parameter;
    public function __construct()
    {
        $this->config  = require_once __DIR__ . '/../../config.php';
        $this->api_url = [
            'detect'=>'https://api-cn.faceplusplus.com/facepp/v3/detect'
        ];
    }

    public function detect(array $params)
    {
        //检测参数
        $url = $this->api_url['detect'];
        $api_params['api_key'] = $this->config['api_key'];
        $api_params['api_secret'] = $this->config['api_secret'];
        if(isset($params['image_base64'])) {
            $api_params['image_base64'] = $params['image_base64'];
        }
        if(isset($params['image_file'])) {
            $api_params['image_file'] = $params['image_file'];
        }
        if(isset($params['image_url'])) {
            $api_params['image_url'] = $params['image_url'];
        }
        $curl = new Curl();
        $curl->post($url,$api_params);
        //$curl->post($url,$api_params);
        var_dump($curl->response);

    }
}