<?php
/**
 * 处理json消息使用
 * User: walkskyer
 * Date: 2016/4/29
 * Time: 15:57
 */

namespace app\components\helpers;
use Yii;

class Json extends \yii\helpers\Json{


    /**
     * 返回统一的code=>msg 方便管理
     * @param bool $key
     * @return array|bool
     * Author: walkskyer
     * Email:zwj_work@qq.com
     */
    public static function code_msg($key = false) {
        static $code_msg;
        if (!$code_msg) {
            /**
             * 数据相关5xx
             * 账户6xx
             * 登录状态7xx
             * 表单字段错误:-60xx(不要轻易占用)
             */
            $code_msg = array(
                1 => '成功',
                -1 => '失败',

                -500 => '参数不正确',
                -501 => '没有可用数据',
                -502 => '数据已存在',
                -503 => '请勿重复操作',
                -504 => '数据不存在，或没有权限访问',
                -505 => 'token 参数丢失',
                -506 => 'token 参数错误',
                -507 => 'token 无效',
                -508 => 'post 数据失败',
            );
        }
        if ($key == false) {
            return $code_msg;
        }
        return isset($code_msg[$key]) ? $code_msg[$key] : false;
    }

    /**
     * 返回成功信息
     * @param $msg
     * @param $userInfo
     */
    public static function success($code = 1, $msg='', $userInfo = '') {
        return self::msg_json($code, $msg, $userInfo);
    }

    /**
     * 返回错误信息
     * @param $msg
     */

    public static function error($code = -1, $msg = '') {
        return self::msg_json($code, $msg, '');
    }

    /**
     * 返回提示信息
     * @param $msg
     */
    public static function info($msg='') {
        return self::msg_json(2, $msg);
    }

    /**
     * 向客户端返回响应信息
     * @param $msg
     * @param int $code
     * @param $userInfo
     */
    public static function msg_json($code = 1, $msg='', $userInfo = '') {
        if (self::code_msg($code) && empty($msg)) {
            $msg = self::code_msg($code);
        }
        return self::show_json(array('msg' => $msg, 'data' => $userInfo, 'code' => $code));
    }

    /**
     * 格式化输出列表数据
     * @param $rows
     * @param $curr_page
     * @param $per_page
     * @param $total_rows
     * @return array
     * Author: walkskyer
     * Email:zwj_work@qq.com
     */
    public static function format_list($rows, $curr_page, $per_page, $total_rows) {
        return array(
            'count' => $total_rows,
            'curr_page' => $curr_page,
            'page_count' => ceil($total_rows / $per_page),
            'perpage' => $per_page,
            'list_data' => $rows
        );
    }

    /**
     * 将数据显示到客户端
     * @param $data
     * @param string $msg
     */
    public static function showData($data, $msg = '') {
        self::show_json(array('code' => 1, 'msg' => $msg, 'data' => $data));
    }

    /**
     * 将数据通过json输出到客户端并退出
     * @param $arr
     * @param int $options
     * @param int $depth
     */
    public static function show_json($arr, $options = 0) {
        header('content-type:application/json;charset=utf-8');
        !$options && $options = JSON_UNESCAPED_UNICODE;
        $req = Yii::$app->getRequest();
        $call_back = $req->get(self::jsonp_param());
        $call_back && $call_back = $req->post(self::jsonp_param());
        if ($call_back) {//jsonp
            die($call_back . '(' . json_encode($arr, $options) . ');');
        }
        die(json_encode($arr, $options));
    }

    /**
     * 返回jsonp参数名
     * @return string
     * Author: walkskyer
     * Email:zwj_work@qq.com
     */
    public static function jsonp_param() {
        return isset($_GET['callback']) ? 'callback' : 'jsonp';
    }

    /**
     * 将json字符串转换成数字返回
     * @param $json
     * @param bool $assoc
     * @param int $depth
     * @param int $options
     * @return mixed
     */
    public static function get_json($json, $assoc = true, $depth = 512, $options = 0) {
        return json_decode($json, $assoc, $depth, $options);
    }
}