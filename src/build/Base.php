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
        $this->config = require_once __DIR__ . '/../../config.php';
        $this->api_url = [
            'detect' => 'https://api-cn.faceplusplus.com/facepp/v3/detect'
        ];
    }

    public function detect(array $params)
    {
        //检测参数
        $url = $this->api_url['detect'];
        try {
            $api_params = $this->setParams($params);
            $curl = new Curl();
            $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
            $curl->post($url, $api_params);
            //$curl->post($url,$api_params);
            if ($curl->error) {
                throw new \Exception('Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n");
            }
            $response = $curl->response;
            return json(200, '请求成功', $response);
        } catch (\Exception $e) {
            return json(405, $e->getMessage());
        }

    }

    private function setParams($params)
    {
        $api_params['api_key'] = $this->config['api_key'];
        $api_params['api_secret'] = $this->config['api_secret'];
        if (isset($params['image_base64'])) {
            $api_params['image_base64'] = $params['image_base64'];
        }
        if (isset($params['image_file'])) {
            $api_params['image_file'] = $params['image_file'];
        }
        if (isset($params['image_url'])) {
            $api_params['image_url'] = $params['image_url'];
        }
        if (!isset($params['image_url']) && !isset($params['image_file']) && !isset($params['image_base64'])) {
            throw new \Exception('参数传递错误');
        }
        if (isset($params['return_landmark'])) {
            if (!in_array($params['return_landmark'], [0, 1, 2])) {
                throw new \Exception('return_landmark,参数传递错误,值应该是0,1,2之间');
            }
            $api_params['return_landmark'] = $params['return_landmark'];
        }
        if (isset($params['return_attributes'])) {
            $Legal_parameters = ['gender', 'age', 'smiling', 'facequality', 'blur', 'eyestatus', 'emotion', 'ethnicity', 'beauty', 'mouthstatus', 'eyegaze', 'skinstatus'];
            $return_attributes = explode(',', trim($params['return_attributes'], ','));
            if (count($return_attributes) < 0) {
                throw new \Exception('return_attributes,参数传递错误');
            }
            foreach ($return_attributes as $attribute) {
                if (!in_array($attribute, $Legal_parameters)) {
                    throw new \Exception('return_attributes,参数传递错误');
                }
            }

            $api_params['return_attributes'] = $params['return_attributes'];
        }
        if (isset($params['calculate_all'])) {
            if (!in_array($params['calculate_all'], [0, 1])) {
                throw new \Exception('calculate_all,参数传递错误,值应该是0,1之间');
            }
            $api_params['calculate_all'] = $params['calculate_all'];
        }
        return $api_params;
    }
}