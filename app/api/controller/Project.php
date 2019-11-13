<?php
namespace app\api\controller;

use app\api\model\Projects;

class Project
{
    public function get_list()
    {
        $data = Projects::get_list();
        return json([
            'code' => 200,
            'data' => $data,
            'msg'  => 'success'
        ]);
    }

    public function add()
    {
        $project = Projects::add(input());
        return json([
            'code' => 200,
            'data' => $project,
            'msg'  => 'success'
        ]);
    }
}
