<?php
namespace Admin\Controller;

use Think\Controller;

class ActivityController extends Controller
{
	protected $type = 1;//1 热销活动，2 招商
    public function index()
    {
        $this->display("disp");
    }
    public function disp(){
		$type = I('get.type');
    	$this->assign("type",$type);
    	$this->show();
    }

    public function edit(){
    	if (IS_POST) {
    		//get type
    		$type = I('post.type');
    		$Activity = M('Activity');
    		if($type == 2){
    			$Activity = M('Business');
    		}

            $title = I('post.title');
    		$content = I('post.content');
    		$arr = array('title' => $title,'content' => $content);
		    $rules = array(
		        array('title', 'require', '标题不得为空!'),
		        array('content', 'require', '内容不得为空！'),
		    );
    		$id = I('post.id');
    		if(mb_strlen($title)>64){
    			$res = 2;//过长
    			$this->redirect("/Admin/Activity/edit?activity_id=$id&type=$type&res=$res");
    			return;
    		}
    		if(!empty($id)){
    			//修改
    			$arr['id'] = $id;
				if($Activity->validate($rules)->create($arr)){
					$Activity->save();
					$res = 0;
				}else{
					$res = 1;//为空
				}
				
    		}else{
    			//新建
    			if ($Activity->validate($rules)->create($arr)) {
	                $id = $Activity->add();
	                $res = 0;
	                if(empty($id)){
	                	$res = 1;
	                }	
            	}else{
            		$res = 1;
            	}
    		}
			redirect("/Admin/Activity/edit?activity_id=$id&res=$res&type=$type");
    	}else{
    		$type = I('get.type');
    		$this->assign("type",$type);
    		$Activity = M('Activity');
    		if($type == 2){
    			$Activity = M('Business');
    		}
	    	$id=I('get.activity_id');
	    	$res=I('get.res');
	    	if(!empty($res)||$res==='0'){
	    		$this->assign("res",$res);
	    	}	 	
	    	if(!empty($id)||$id==='0'){	
	    		$res = $Activity->where("id=$id")->find();
	    		$this->assign("activity_info",$res);
	    		$this->assign("isEdit",1);
	    	}
	    	$this->display("edit");  		
    	}

    	
    }
    public function delete(){
    	$type = I('get.type');
    	$id=I('get.activity_id');
    	$Activity = M('Activity');
    	if($type == 2){
    		$Activity = M('business');
    	}
    	$result = $Activity->delete($id);
    	if($result === 0){
    		$this->assign("error",1);
    	}else if($result === false){
			$this->assign("error",2);
			
    	}else{
    		$this->assign("error",-1);
    	}
    	$this->display("disp");
    }
    public function get_activity(){        
        if (IS_POST) {
            $order = I('post.order');
            $search = I('post.search');
            $columns = I('post.columns');
            $type = I('post.type');
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
    		if($type == 2){
    			$Activity = M('business');
    		}
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
                if(mb_strlen($item['content'])>30){
                	// echo 1;
					$data_info['content'] = mb_substr($item['content'],0,30,'utf-8')."...";
                }else{
                	// echo 2;
                	$data_info['content'] = $item['content'];
                }

                $data['data'][] = $data_info;
            }            
            $this->ajaxReturn($data);
        } else {
            $this->error("此接口用于查看活动列表");
        }
    }    
}