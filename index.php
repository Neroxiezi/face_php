<?php
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2018/7/13
 * Time: 16:52
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
$file = './data.log';
function get_log_y($path)
{
    $result = fopen($path, 'a+');
    //var_dump(feof($result));exit;
    try {
        while (!feof($result)) {
            yield fgets($result);
        }
    } finally {
        fclose($result);
    }
}

$data = get_log_y($file);
foreach ($data as $val) {
    if (!$val) {
        continue;
    }
    $data = json_decode($val, true);
}
/*var_dump($data);
exit;*/
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>打分</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<div style="width:40%;border: 1px solid #cccccc;margin: 0 auto">

    <?php
    foreach ($data as $datum) {
        //var_dump($datum['data']['ethnicity']['value']);exit;
        ?>
        <ul style="display: flex;justify-content:space-between">
            <li style="list-style: none;flex: 1;"><img src="<?php echo './uploads/' . $datum['photo']; ?>"
                                                       style="width: 100%;" alt=""></li>
            <li style="list-style: none;flex: 6;">
                <table cellspacing="0" border="1" cellpadding="5" style="border-style: dotted;width: 100%;">
                    <tr style="text-align: center">
                        <th>人种</th>
                        <th>性别</th>
                        <th>年龄</th>
                        <th>颜值分</th>
                    </tr>
                    <tr style="text-align: center">
                        <td><?php
                            switch ($datum['data']['ethnicity']['value']) {
                                case 'ASIAN':
                                    echo '亚洲人';
                                    break;
                                case 'WHITE':
                                    echo '白人';
                                    break;
                                case 'BLACK':
                                    echo '黑人';
                                    break;
                            }
                            ?></td>
                        <td>
                            <?php echo $datum['data']['gender']['value'] == 'Female' ? '女' : '男' ?>
                        </td>
                        <td>
                            <?php echo $datum['data']['age']['value']; ?>
                        </td>
                        <td>
            <li style="list-style: none">女性喜欢:<?php echo $datum['data']['beauty']['female_score'] ?></li>
            <li style="list-style: none">男性喜欢:<?php echo $datum['data']['beauty']['male_score'] ?></li>
            </td>
            </tr>
            </table>
            </li>
        </ul>
        <?php
    } ?>

</div>
</body>
</html>

