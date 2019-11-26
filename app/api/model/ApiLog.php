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
 * @property $api_param api参数
 * @property $api_response api响应
 * @property $is_success 成功|失败 1|0
 * @property $consume_time 消耗时间 单位ms
 * @property $user_from 用户来源，可以填入ip、城市名、调用账号等类型
 * @property $user_identify 用户标识，比如可以用订单号，结合来源，就可以定位请求
 * @property $create_date 记录日期  YYYYddmm
 * @property $create_time 记录时间
 */
class ApiLog extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    protected $pk = 'id';
    protected $updateTime = false;

    public static function report($data)
    {
        $category      = $data['category'];
        $method        = $data['method'];
        $consume_time  = $data['consume_time'];
        $is_success    = $data['is_success']?? 1;
        $user_from     = $data['user_from'] ?? '';
        $user_idenfity = $data['user_identify'] ?? '';
        $api_param     = $data['api_param'] ?? '';
        $api_response  = $data['api_response'] ?? '';

        $apiLog                = new static();
        $apiLog->api_category  = $category;
        $apiLog->api_method    = $method;
        $apiLog->api_full      = $category."/".$method;
        $apiLog->consume_time  = $consume_time;
        $apiLog->is_success    = $is_success;
        $apiLog->user_from     = $user_from;
        $apiLog->create_date   = date("Ymd");
        $apiLog->user_identify = $user_idenfity;
        $apiLog->api_param     = $api_param;
        $apiLog->api_response  = $api_response;
        $apiLog->save();

        return $apiLog;
    }

    public static function getOverview($project_id = null, $date = null)
    {
        $where = [];
        if ($project_id !==null) {
            $where[] = ['project_id', '=', $project_id];
        }
        if ($date === NULL){
            $date = date("Ymd");
        }

        $where[] = ['create_date', '=', (int)$date];

        $data = new static();
        $res = $data->field("DATE_FORMAT(`create_time`, '%H:%i') AS time, count(id) as num, 
        sum(CASE WHEN is_success = 1 THEN 1 ELSE 0 END) AS success_times,
        sum(CASE WHEN is_success = 0 THEN 1 ELSE 0 END) AS fail_times")
            ->group("time")->order("time")
            ->where($where)
            ->select()->toArray();
        return $res;
    }

    public static function proportion($project_id = null, $date = null)
    {
        $where = [];
        if ($project_id !==null) {
            $where[] = ['project_id', '=', $project_id];
        }
        if ($date === NULL){
            $date = date("Ymd");
        }

        $where[] = ['create_date', '=', (int)$date];

        $model = new static();
        $res   = $model->field("api_full,count(id) as num,
        sum(CASE WHEN is_success = 1 THEN 1 ELSE 0 END) AS success_times,
        sum(CASE WHEN is_success = 0 THEN 1 ELSE 0 END) AS fail_times,
        avg(consume_time) as avg_consume_time
        ")->group("api_full")->order("num", "DESC")
            ->where($where)
            ->select()->toArray();

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

    public static function user_from_list($project_id)
    {
        $where = [
            ['project_id', '=', $project_id]
        ];

        $model = new static();
        $res   = $model->field("user_from")->where($where)->group("user_from")->select();
        return $res;
    }

    public static function detail($input)
    {
        $detail = static::where("user_from", $input['user_from'])
            ->where("user_identify", $input['user_identify'])
            ->where('project_id', $input['project_id'])
            ->find();

        if($detail){
            $detail['api_param'] = json_decode($detail['api_param'], true);
        }

        return $detail;

    }

    /**
     * 查询周期内平均qps
     * @param int $second
     * @param $project_id
     * @return array
     */
    public static function getQpsInfo($second = 5, $project_id)
    {
        $start_time = date("Y-m-d H:i:s", time() - $second);
        $end_time   = date("Y-m-d H:i:s");

        $count = static::where('create_time', 'between', [$start_time, $end_time])
            ->where('project_id', $project_id)
            ->count();
        $qps   = bcdiv($count, $second, 2);
        return [
            'count' => $count,
            'qps'   => $qps,
        ];
    }
}