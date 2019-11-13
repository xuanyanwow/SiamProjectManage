<?php
namespace app\api\model;

use think\Model;

class Projects extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    protected $pk = 'project_id';

    /**
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function get_list()
    {
        $list  = (new Projects)->select();
        $count = (new Projects)->count("project_id");

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

    /**
     * @param $id
     * @return bool
     * @throws
     */
    public static function deleteById($id)
    {
        $project = (new Projects)->find($id);

        if (!$project){
            return false;
        }

        return $project->delete();
    }
}