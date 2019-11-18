<?php
/**
 * Created by PhpStorm.
 * User: Siam
 * Date: 2019/11/18
 * Time: 16:07
 */

namespace app\api\bean;


use EasySwoole\Spl\SplBean;

class ApiLogBean extends SplBean
{
    protected $api_full;
    protected $api_category;
    protected $api_method;
    protected $is_success;
    protected $consume_time;
    protected $user_from;
    protected $create_date;

    /**
     * @return mixed
     */
    public function getApiFull()
    {
        return $this->api_full;
    }

    /**
     * @param mixed $api_full
     */
    public function setApiFull($api_full): void
    {
        $this->api_full = $api_full;
    }

    /**
     * @return mixed
     */
    public function getApiCategory()
    {
        return $this->api_category;
    }

    /**
     * @param mixed $api_category
     */
    public function setApiCategory($api_category): void
    {
        $this->api_category = $api_category;
    }

    /**
     * @return mixed
     */
    public function getApiMethod()
    {
        return $this->api_method;
    }

    /**
     * @param mixed $api_method
     */
    public function setApiMethod($api_method): void
    {
        $this->api_method = $api_method;
    }

    /**
     * @return mixed
     */
    public function getisSuccess()
    {
        return $this->is_success;
    }

    /**
     * @param mixed $is_success
     */
    public function setIsSuccess($is_success): void
    {
        $this->is_success = $is_success;
    }

    /**
     * @return mixed
     */
    public function getConsumeTime()
    {
        return $this->consume_time;
    }

    /**
     * @param mixed $consume_time
     */
    public function setConsumeTime($consume_time): void
    {
        $this->consume_time = $consume_time;
    }

    /**
     * @return mixed
     */
    public function getUserFrom()
    {
        return $this->user_from;
    }

    /**
     * @param mixed $user_from
     */
    public function setUserFrom($user_from): void
    {
        $this->user_from = $user_from;
    }

    /**
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * @param mixed $create_date
     */
    public function setCreateDate($create_date): void
    {
        $this->create_date = $create_date;
    }


}