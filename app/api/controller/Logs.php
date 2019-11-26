<?php
/**
 * Created by PhpStorm.
 * User: Siam
 * Date: 2019/11/25
 * Time: 18:24
 */

namespace app\api\controller;


use app\BaseController;

class Logs extends BaseController
{
    public function query()
    {
        $this->validate(input(), [
            "project_id" => 'require',
            "log_sn"     => 'require',
        ]);

        $list = \app\api\model\Logs::query(input('project_id'), input('log_sn'));
        return json([
            'code' => 200,
            'data' => $list,
            'msg'  => 'success'
        ]);
    }

    public function report()
    {
        $this->validate(input(), [
            "project_id"   => 'require',
            "log_sn"       => 'require',
            "log_category" => 'require',
            "log_point"    => 'require',
            "log_data"     => 'require',
            "log_from"     => 'require',
        ]);

        $res = \app\api\model\Logs::report(input());

        return json([
            'code' => 200,
            'data' => [],
            'msg'  => 'success'
        ]);
    }
}