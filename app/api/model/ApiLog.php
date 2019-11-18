<?php
/**
 * Created by PhpStorm.
 * User: Siam
 * Date: 2019/11/18
 * Time: 15:59
 */

namespace app\api\model;


use think\Model;

/**
 * @property $id
 * @property $api_full api路径 = api类目.\"/\".api方法
 * @property $api_category api类目
 * @property $api_method api方法
 * @property $is_success 成功|失败 1|0
 * @property $consume_time 消耗时间 单位ms
 * @property $user_from 用户来源，可以填入ip、城市名、调用账号等类型
 * @property $create_date 记录日期  YYYYddmm
 * @property $create_time 记录时间
 */
class ApiLog extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    protected $pk = 'id';
    protected $updateTime = false;

    public static function report($category, $method, $consume_time, $is_success = 1, $user_from = '')
    {
        $apiLog               = new static();
        $apiLog->api_category = $category;
        $apiLog->api_method   = $method;
        $apiLog->api_full     = $category."/".$method;
        $apiLog->consume_time = $consume_time;
        $apiLog->is_success   = $is_success;
        $apiLog->user_from    = $user_from;
        $apiLog->create_date  = date("Ymd");
        $apiLog->save();

        return $apiLog;
    }

    public static function getOverview()
    {
        $data = new static();
        $res = $data->field("DATE_FORMAT(`create_time`, '%H:%i') AS time, count(id) as num, 
        sum(CASE WHEN is_success = 1 THEN 1 ELSE 0 END) AS success_times,
        sum(CASE WHEN is_success = 0 THEN 1 ELSE 0 END) AS fail_times")
            ->group("time")->order("time")->select()->toArray();
        return $res;
    }

    public static function proportion()
    {
        $model = new static();
        $res   = $model->field("api_full,count(id) as num,
        sum(CASE WHEN is_success = 1 THEN 1 ELSE 0 END) AS success_times,
        sum(CASE WHEN is_success = 0 THEN 1 ELSE 0 END) AS fail_times,
        avg(consume_time) as avg_consume_time
        ")->group("api_full")->order("num", "DESC")->select()->toArray();

        $total = array_sum(array_column($res, "num"));

        foreach ($res as $key => $value){
            $res[$key]['proportion'] = (bcdiv($value['num'], $total, 5) * 100)."%";
            if ($value['success_times'] == 0){
                $res[$key]['can_use'] = 0;
            }else{
                $res[$key]['can_use']    = (bcdiv($value['success_times'], $value['num'], 4) * 100)."%";
            }
        }

        return $res;
    }
}