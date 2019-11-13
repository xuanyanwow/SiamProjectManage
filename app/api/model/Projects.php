<?php
namespace app\api\model;

use think\Model;

class Projects extends Model
{
    protected $autoWriteTimestamp = 'datetime';

    public static function get_list()
    {
        $list  = static::select();
        $count = static::count("project_id");

        return [
            'list'  => $list,
            'count' => $count
        ];
    }

    public static function add($data)
    {
        $project = new static();
        $project->save($data);
        return $project;
    }
}