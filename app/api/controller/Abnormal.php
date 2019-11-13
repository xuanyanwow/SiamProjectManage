<?php
namespace app\api\controller;


use app\api\model\Abnormals;
use app\BaseController;

class Abnormal extends BaseController
{
    /**
     * 获取最近统计
     */
    public function get_static()
    {
        $static = Abnormals::getStaticByDate(date('Y-m-d'), input('project_id', NULL));

        return json([
            'code' => 200,
            'data' => $static,
            'msg'  => 'success'
        ]);
    }

    /**
     * 获取项目异常列表
     */
    public function get_list()
    {
        $data = Abnormals::get_list(input('page'), input('limit'), input('project_id', NULL));
        return json([
            'code' => 200,
            'data' => $data,
            'msg'  => 'success'
        ]);
    }

    /**
     * 根据异常id获取详情，包括文件资源、参数等
     * @return \think\response\Json
     */
    public function get_detail()
    {
        $id = input('ab_id');

        if (!$id){
            return json(['code' => 400]);
        }

        $data = Abnormals::getDetailById($id);

        return json([
            'code' => 200,
            'data' => $data,
            'msg'  => 'success'
        ]);

    }
}