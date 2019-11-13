<?php
namespace app\api\controller;

class Project
{
    public function get_list()
    {
        $list = [
            [
                'id' => 1,
                'name' => 'Payment'
            ],[
                'id' => 2,
                'name' => '娃娃机'
            ],
        ];
        return json([
            'code' => 200,
            'data' => [
                'list' => $list
            ],
            'msg'  => 'success'
        ]);
    }
}
