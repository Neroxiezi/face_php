<?php
/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2018/7/12
 * Time: 17:05
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

use pf\face\PFace;

require './vendor/autoload.php';
$file = "fc.jpeg";

$resource = opendir('./uploads');
//dd($resource);
while ($filename = readdir($resource)) {
    if($filename=='.' ||$filename=='..' ) {
        continue;
    }
    $file_path = './uploads/'.$filename;
    if ($fp = fopen($file_path, "rb", 0)) {
        $gambar = fread($fp, filesize($file_path));
        fclose($fp);
        $base64 = chunk_split(base64_encode($gambar));
        // 输出
    }
    $arr = [
        'image_base64' => $base64,
        'return_attributes' => 'age,gender,smiling,emotion,ethnicity,beauty,skinstatus'
    ];
    $face_info = json_decode(PFace::detect($arr), true);
    $face_coordinate = $face_info['data'];
    $data[] = ['photo'=>$filename,'data'=>$face_coordinate['faces'][0]['attributes']];
}

file_put_contents('./data.log',json_encode($data));



