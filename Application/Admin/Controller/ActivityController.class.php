<?php
namespace Admin\Controller;

use Think\Controller;

class ActivityController extends Controller
{
    public function index()
    {
        $this->display("disp");
    }
    public function delete(){
    	
    }
    public function get_activity(){        
        if (IS_POST) {
            $order = I('post.order');
            $search = I('post.search');
            $columns = I('post.columns');
            // 排序条件
            $order_arg = array();
            if (!empty($order)) {
                for ($i = 0; $i < count($order); $i++) {
                    if ($columns[$order[$i]['column']]['orderable'] == 'true') {
                        $order_arg[$columns[$order[$i]['column']]['data']] = $order[$i]['dir'];
                    }
                }
            }
            $order_arg['id'] = 'desc';
            // 搜索条件(name字段)
            $search_arg = array();
            if ($search['value'] != '') {
                for ($i = 0; $i < count($columns); $i++) {
                    if ($columns[$i]['searchable'] == 'true') {
                        $search_arg[$columns[$i]['data']] = array('like', '%' . $search['value'] . '%');                      
                    }
                }
                $search_arg['_logic'] = 'OR';
            }
            $Activity = M('activity');
    
            $client_list = $Activity->where($search_arg)->order($order_arg)->limit(I('post.start'), I('post.length') == -1 ? PHP_INT_MAX : I('post.length'))->select();
            $recordsTotal = $Activity->where($search_arg)->count();

            $data = array();
            $data["draw"] = intval(I('post.draw'));
            $data["recordsTotal"] = $recordsTotal;
            $data["recordsFiltered"] = $data["recordsTotal"];
            $data['data'] = array();
            $count = 1;
            $address_content = file_get_contents("./Public/address_code.json");
            $address_code = json_decode($address_content, true);
            foreach ($client_list as $item){
                $data_info = array();
                $data_info['empty'] = '';
                $data_info['no'] = $count++;
                $data_info['id'] = $item['id'];
                $data_info['title'] = $item['title'];
                $data_info['content'] = $item['content'];
                $data['data'][] = $data_info;
            }            
            $this->ajaxReturn($data);
        } else {
            $this->error("此接口用于查看活动列表");
        }
    }    
}