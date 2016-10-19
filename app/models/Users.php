<?php
/**
 * Created by PhpStorm.
 * User: user01
 * Date: 16-10-19
 * Time: 下午2:49
 */

use Phalcon\Mvc\Model;

class Users extends Model
{
    //采用默认的对应规则会自动映射数据库表的字段，可以不写
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $email;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */

    public function getSource()
    {
        return 'users';
    }

    public function initialize()
    {
        $this->setSource('users');
        $this->setConnectionService('users');
//        $this->setSource('users');
    }

}
