<?php
/**
 * Created by PhpStorm.
 * User: Siam
 * Date: 2019/11/18
 * Time: 16:05
 */

namespace app\api\controller;

use app\api\bean\ApiLogBean;
use app\api\model\ApiLog as Model;
use app\BaseController;

class ApiLog extends BaseController
{
    public function report()
    {
        $this->validate(input(), [
            "category"     => 'require',
            "method"       => 'require',
            "consume_time" => 'require',
        ]);

        $apiLog = Model::report(input('category'), input('method'), input('consume_time'), input('is_success', 1), input('user_from', ''));

        return json([
            'code' => 200,
            'data' => $apiLog,
            'msg'  => 'success'
        ]);
    }

    public function overview()
    {
        $date = $this->initDateArray();
        $data = Model::getOverview();

        return json([
            'code' => 200,
            'data' => [
                'date' => $date,
                'data' => $data,
            ],
            'msg'  => 'success'
        ]);
    }


    public function proportion()
    {
        $data = Model::proportion();

        return json([
            'code' => 200,
            'data' => [
                'list' => $data,
                'count' => count($data),
            ],
            'msg'  => 'success'
        ]);
    }

    protected function initDateArray($date = NULL)
    {
        $all_second = 1440;
        $period = 1;// 5分钟

        if ($date === NULL){
            $date = "Y-m-d";
        }
        $start_time = strtotime(date("{$date} 00:00:00"));
        $array = [];

        for($i = 0; $i <= ($all_second / $period); $i++)
        {
            $array[] = date("H:i", $start_time + ($i * $period * 60) );
        }
        return $array;
    }
}