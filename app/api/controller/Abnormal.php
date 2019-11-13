<?php
namespace app\api\controller;


use app\api\bean\AbnormalBean;
use app\api\exception\ProjectException;
use app\api\model\Abnormals;
use app\api\model\Projects;
use app\BaseController;
use think\Validate;

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

    /**
     * 异常上报
     * 测试地址 : {{api}}/api/abnormal/report
     * post   : project_id=10&ab_class=TestExceptionClass&ab_date=2019-11-13&ab_message=测试异常消息
     * 可选   :
     * $ab_data 数据 json字符串 {"get":{}, "post":{}, "head":{} }...
     * $ab_fileresources 文件资源 json字符串 [{"is_hight":0, "text": "代码", "line" :100}, {"is_hight":1, "text": "代码2", "line" :101}]
     * @return \think\response\Json
     * @throws
     */
    public function report()
    {
        $bean = new AbnormalBean(input());
        $bean->setAbDate(date("Y-m-d"));

        $this->validate($bean->toArray(), [
            "project_id"    => "require",
            "ab_class"      => "require",
            "ab_date"       => "require",
            "ab_message"    => "require",
        ]);

        // 项目必须存在
        $project = (new Projects)->find($bean->getProjectId());
        if (!$project){
            throw new ProjectException("项目不存在");
        }

        $abnormal = Abnormals::report($bean);

        return json([
            'code' => 200,
            'data' => $abnormal,
            'msg'  => 'success'
        ]);
    }
}