<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/13 0013
 * Time: 23:11
 */

namespace app\api\bean;


use EasySwoole\Spl\SplBean;

class AbnormalBean extends SplBean
{
    protected $ab_id;
    protected $project_id;
    protected $ab_class;
    protected $ab_date;
    protected $ab_data = "{}";
    protected $ab_fileresources;
    protected $ab_message;
    protected $create_time;
    protected $update_time;

    /**
     * @return mixed
     */
    public function getAbId()
    {
        return $this->ab_id;
    }

    /**
     * @param mixed $ab_id
     */
    public function setAbId($ab_id): void
    {
        $this->ab_id = $ab_id;
    }

    /**
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * @param mixed $project_id
     */
    public function setProjectId($project_id): void
    {
        $this->project_id = $project_id;
    }

    /**
     * @return mixed
     */
    public function getAbClass()
    {
        return $this->ab_class;
    }

    /**
     * @param mixed $ab_class
     */
    public function setAbClass($ab_class): void
    {
        $this->ab_class = $ab_class;
    }

    /**
     * @return mixed
     */
    public function getAbDate()
    {
        return $this->ab_date;
    }

    /**
     * @param mixed $ab_date
     */
    public function setAbDate($ab_date): void
    {
        $this->ab_date = $ab_date;
    }

    /**
     * @return string
     */
    public function getAbData(): string
    {
        return $this->ab_data;
    }

    /**
     * @param string $ab_data
     */
    public function setAbData(string $ab_data): void
    {
        $this->ab_data = $ab_data;
    }

    /**
     * @return mixed
     */
    public function getAbFileresources()
    {
        return $this->ab_fileresources;
    }

    /**
     * @param mixed $ab_fileresources
     */
    public function setAbFileresources($ab_fileresources): void
    {
        $this->ab_fileresources = $ab_fileresources;
    }

    /**
     * @return mixed
     */
    public function getAbMessage()
    {
        return $this->ab_message;
    }

    /**
     * @param mixed $ab_message
     */
    public function setAbMessage($ab_message): void
    {
        $this->ab_message = $ab_message;
    }

    /**
     * @return mixed
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * @param mixed $create_time
     */
    public function setCreateTime($create_time): void
    {
        $this->create_time = $create_time;
    }

    /**
     * @return mixed
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * @param mixed $update_time
     */
    public function setUpdateTime($update_time): void
    {
        $this->update_time = $update_time;
    }



}