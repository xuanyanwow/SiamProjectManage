<?php
/**
 * Created by PhpStorm.
 * User: Siam
 * Date: 2019/11/25
 * Time: 14:47
 */

namespace app\api\controller;


use app\api\model\Projects;
use app\BaseController;
use think\facade\Env;

class Console extends BaseController
{
    public function get_data()
    {
        $projectNum = Projects::count();
        $exceptionNum = 0;
        $needDoExceptionNum = 0;
        $runDay = date('Ymd') - Env::get('install.install_day');
        $min = [
            $projectNum,$exceptionNum, $needDoExceptionNum, $runDay
        ];

        $exception = [];

        return json([
            'code' => 200,
            'data' => [
                'min' => $min,
                'exception' => $exception,
            ],
        ]);
    }
}