<?php
/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2018/7/12
 * Time: 16:55
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

namespace pf\face;


use pf\face\build\Base;

class PFace
{
    protected $pf_array_link;
    protected function driver()
    {
        $this->pf_array_link = new Base();
        return $this;
    }

    public function __call($method, $params)
    {
        if (is_null($this->pf_array_link)) {
            $this->driver();
        }
        if (method_exists($this->pf_array_link, $method)) {
            return call_user_func_array([$this->pf_array_link, $method], $params);
        }
    }

    public static function single()
    {
        static $pf_array_link;
        if (is_null($pf_array_link)) {
            $pf_array_link = new static();
        }
        return $pf_array_link;
    }
    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([static::single(), $name], $arguments);
    }
}