<?php
namespace Common\Model;

use Think\Model;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/15
 * Time: 9:20
 */
class BaseModel extends Model
{

    protected $_table = '';

    /**
     * 保证每个类只有一个实例
     * @param $args
     * @return mixed|static|self
     */
    public static function instance($args = null)
    {
        $class = get_called_class();
        static $instance;
        if (isset($instance[ $class ])) {
            return $instance[ $class ];
        }

        $obj = new $class($args);
        $instance[ $class ] = $obj;

        return $instance[ $class ];
    }


    public function insert($data , $table = '')
    {
        $data['created_at'] = time();
        if ($table){
            $m = D($table);
        }else{
            $m = D($this->_table);
        }

        if ($r = $m->create($data)) {
            return $m->add();
        } else {
            return $m->getError();
        }

    }

    public function del($id)
    {
        if (intval($id) <= 0) return false;
        $m = M($this->_table);

        return $m->where("id=" . $id)->delete();
    }

    public function edit($data, $where = [] , $table = '')
    {
        $table = $table == '' ? $this->_table : $table;

        $m = D($table);

        if ($dataProcess = $m->create($data)) {
            $where = empty($where) ? array('id' => $data['id']) : $where;

            return $m->where($where)->save($dataProcess);
        } else {
            return $m->getError();
        }

    }

    public function findById($id)
    {
        $m = M($this->_table);

        return $m->where(["id" => $id])->find();
    }

    public function findByProperties($fieldName = 'id' , $fieldValue = '' , $table = ''){
        $table = $table == '' ? $this->_table : $table;
        $m = M($table);
        $where[$fieldName] = $fieldValue;
        return $m->where($where)->select();
    }

}