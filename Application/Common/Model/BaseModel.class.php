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
     * @return mixed|static
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


    public function insert($data)
    {
        $m = D($this->_table);
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

    public function edit($data, $where = [])
    {
        $m = D($this->_table);

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

    public function findByProperties($fieldName = 'id' , $fieldValue = ''){
        $m = M($this->_table);
        $where[$fieldName] = $fieldValue;
        return $m->where($where)->select();
    }

}