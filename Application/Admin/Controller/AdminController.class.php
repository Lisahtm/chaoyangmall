<?php
namespace Admin\Controller;

use Think\Controller;

class AdminController extends Controller {
    public function _initialize() {
        //check login

    }

    public function index() {
    	if (!self::is_login()) {
	        $this->redirect('Admin/login');
	    }else 
        	$this->display();
    }
    protected static function get_token($user_id, $user_name) {
        return md5($user_id . $user_name . time());
    } 
    public static function is_login() {
        if (session('admin_id')) {
            return true;
        }
        $user_id = cookie('admin_id');
        $user_token = cookie('admin_token');
        if (!empty($user_id) && !empty($user_token)) {
            if (self::check_token($user_id, $user_token)) {
                session('admin_id', $user_id);
                return true;
            }
        }
        return false;
    }   
    protected static function auth($account, $password) {
        if (empty($account) or empty($password)) {
            return null;
        }

        $User = M('Admin');
        $condition['name'] = $account;
        $condition['password'] = $password;
        $user_info = $User->where($condition)->find();
        if (empty($user_info)) {
            return $user_info;
        }

        $user_token = self::get_token($user_info['id'], $user_info['name']);
        if ($User->where('id='.$user_info['id'])->setField('token', $user_token)) {
            $user_info['token'] = $user_token;
        } else {
            $user_info['token'] = null;
        }

        return $user_info;
    }    
    public function login(){
        if (IS_POST) {
            $account = I('post.account');
            $password = I('post.password');
            $remember = I('post.remember');
            $user_info = self::auth($account, $password);
            if (!empty($user_info)) {
                if ($remember == 'remember' && $user_info['token']) {
                    cookie('admin_id', $user_info['id']);
                    cookie('admin_token', $user_info['token']);
                }
                session('admin_id', $user_info['id']);
                var_dump("1111");
                $this->redirect('Admin/index');
            } else {
                $this->assign('error', 1);
                $this->assign('msg', '用户名或密码错误');
                $this->display();
            }
        } else {
            if (self::is_login()) {
                $this->redirect('Admin/index');
            } else {
                $this->display();
            }
        }

    }
    public function logout() {
        session('admin_id', null);
        cookie(null, C('COOKIE_PREFIX'));
        $this->redirect('login');              
        
    }
}