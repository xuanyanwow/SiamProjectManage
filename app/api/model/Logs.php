<?php
/**
 * Created by PhpStorm.
 * User: Siam
 * Date: 2019/11/25
 * Time: 18:26
 */

namespace app\api\model;


use think\Model;

class Logs extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    protected $pk = 'id';
    protected $updateTime = false;
    protected $createTime = "create_at";

    public static function query($project_id, $log_sn)
    {
        return static::where("project_id", $project_id)->where("log_sn", $log_sn)->select();
    }

    public static function report($input)
    {
        $model = new static($input);
        return $model->save() ? $model : false;
    }
}