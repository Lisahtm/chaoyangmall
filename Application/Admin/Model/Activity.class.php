<?php
namespace Admin\Model;

use Think\Model;

class AdminModel extends Model {
    protected $_validate = array(
        array('title', 'require', '必须有标题!', 1),
        array('content', 'require', '必须有内容！', 1, 'unique'),
    );

}
