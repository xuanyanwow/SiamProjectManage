<?php
namespace app\api\model;

use think\Model;

class Projects extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    protected $pk = 'project_id';

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

    public static function deleteById($id)
    {
        $project = static::find($id);

        if (!$project){
            return false;
        }

        return $project->delete();
    }
}