<?php
namespace Admin\Controller;

use Think\Controller;

class CompanyController extends Controller {
    public function _initialize() {
        if (!AdminController::is_login()) {
            $this->redirect('Admin/index');
        }
    }
    public function index() {
        $this->display("disp");
    }    
    public function upload_image($filename) {
        $filename = str_replace('?','',$filename);
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 2 * 1024 * 1024;
        $upload->rootPath = C('UPLOAD_PATH');
        $upload->savePath = '';
        $upload->saveName = $filename;
        $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');
        $upload->mimes    = array('image/jpg', 'image/gif', 'image/png', 'image/jpeg');
        $upload->autoSub  = true;
        $upload->subName  = array('date','Y-m-d');
        $info = $upload->uploadOne($_FILES['photo']);
        if ($info) {
            $photo_path = C('UPLOAD_PATH').$info['savepath'];
            $photo_name = $info['savename'];
            // $thumb_name = $this->get_thumb($photo_path, $photo_name);
            // return substr($photo_path.$thumb_name, 1);
            return substr($photo_path.$photo_name, 1);
        } else {
            // $this->error($upload->getError());
            return null;
        }
    }

    public function delete(){
        $id=I('get.id');
        $Company = M('Company');
        if(empty($id)&&$id!==0){
            $this->error("id为空！");
            return;
        } 
        $item = $Company->where("id=$id");
        if(empty($item)){
            $this->error("无本条记录！");
            return;
        }
        unlink($Company->where("id=$id")->getField('photo'));
        $result = $Company->delete($id);
        if($result === 0){
            $this->assign("error",1);
        }else if($result === false){
            $this->assign("error",2);
            
        }else{
            $this->assign("error",-1);
        }
        $this->redirect("Company/disp");
    }    
    protected function get_thumb($photo_path, $photo_name) {
        $image = new \Think\Image();
        $image->open($photo_path.$photo_name);
        $thumb_name = 'thumb_'.$photo_name;
        $image->thumb(256, 256)->save($photo_path.$thumb_name);
        unlink($photo_path.$photo_name);
        return $thumb_name;
    }
    public function edit() {
        if (IS_POST) {
            $id = intval(I('post.id'));
            $data['name'] = I('post.name');
            $data['content'] = I('post.content');
            if(!empty($id)){
                $data['id'] = $id;
            }
            $Company = M('Company');
            if ($Company->create($data)) {
                if(!empty($id)){
                    $result = $Company->save();
                }else{
                    $result = $Company->add();
                    $id = $result;
                }
                if ($result !== false) {
                    $new_photo = $this->upload_image($data['name'].'_'.date('Ymd').'_'.mt_rand());
                    if (!empty($new_photo)) {
                        $old_photo = $Company->where('id='.$id)->getField('photo');
                        if ($new_photo != $old_photo) { // 防止重名
                            unlink('.' . $old_photo);
                            $Company->where('id='.$id)->setField('photo', $new_photo);
                        }
                    }
                    $this->assign('result', 1);
                } else {
                    $this->assign('result', -1);
                    $this->assign('msg', $Company->getError());
                }
            } else {
                $this->assign('result', -1);
                $this->assign('msg', $Company->getError());
            }

            $this->display();
        } else {
            $query = IndexController::get_querystring();
            if (array_key_exists('id', $query)) {
                $company_id = intval($query['id']);
                $company_info = $this->get_company($company_id);
                $this->assign('company_info', $company_info);
                $this->display();
            } else {
                // $this->redirect('/Admin/Company/disp');
                $this->display();
            }
            
        }
    }
    function get_company($id){
        $Company = M('Company');
        $company_info = $Company->where('id='.$id)->find();
        return $company_info;       
    }
    public function disp() {
        $this->display();
    }
   public function get_companylist(){        
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
            
            $Company = M('Company');
            $client_list = $Company->where($search_arg)->order($order_arg)->limit(I('post.start'), I('post.length') == -1 ? PHP_INT_MAX : I('post.length'))->select();
            $recordsTotal = $Company->where($search_arg)->count();

            $data = array();
            $data["draw"] = intval(I('post.draw'));
            $data["recordsTotal"] = $recordsTotal;
            $data["recordsFiltered"] = $data["recordsTotal"];
            $data['data'] = array();
            $count = 1;
            foreach ($client_list as $item){
                $data_info = array();
                $data_info['empty'] = '';
                $data_info['no'] = $count++;
                $data_info['id'] = $item['id'];
                $data_info['name'] = $item['name'];
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