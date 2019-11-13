<?php
namespace app\api\controller;

class Exception
{
    public function get_list()
    {
        $list = [
            [
                'ab_id' => 1,
                'ab_class' => 'Payment',
                'create_time' => "2019-11-13 10:09:19",
                'ab_message' => '测试'
            ],
            [
                'ab_id' =>2,
                'ab_class' => 'Payment',
                'create_time' => "2019-11-13 10:09:19",
                'ab_message' => '测试'
            ]
        ];
        return json([
            'code' => 200,
            'data' => [
                'list' => $list,
                'count' => 123,
            ],
            'msg'  => 'success'
        ]);
    }
}
