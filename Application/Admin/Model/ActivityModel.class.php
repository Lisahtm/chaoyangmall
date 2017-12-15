<?php
namespace Admin\Model;

use Think\Model;

class ActivityModel extends Model {
    protected $_validate = array(
        array('title', 'require', '必须有标题!'),
        array('content', 'require', '必须有内容！'),
    );

}
