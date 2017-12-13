<?php
namespace Admin\Model;

use Think\Model;

class AdminModel extends Model {
    protected $_validate = array(
        array('name', 'require', '名称必须!', 1),
        array('name', '', '帐号名称已经存在!', 1, 'unique'),
        array('password', 'require', '密码必须!', 1),
        array('repassword', 'password', '确认密码不正确', 1, 'confirm'),
    );

    protected $_auto = array(
        array('password', 'md5', 3, 'function'),
        //array('register_time', 'time', 1, 'function')
    );
}
