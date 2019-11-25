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
}