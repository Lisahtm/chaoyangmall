<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
	public static function get_querystring() {
        $query = array();
        $querystring = htmlspecialchars_decode(explode('?', I('server.REQUEST_URI'))[1]);
        if (strlen($querystring) > 0) {
            parse_str($querystring, $query);
        }
        return $query;
    }
    public function index()
    {
       $this->redirect('Admin/index');
    }
}