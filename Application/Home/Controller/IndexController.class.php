<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function introduction(){
        $this->assign("tab_type",1);
        $this->display();
    }
    public function test(){
        $Activity = M("Activity");
        $dbname = "chaoyangmall_activity";
        $list = $Activity->query("select * from $dbname LIMIT 1,2");
        $a=2;
        $b="$a*5";
        var_dump($b);
        var_dump($list);
    }
    public function index()
    {
        $this->assign("tab_type",0);
    	$Activity = M('Activity');
    	$activityList = $Activity->order("create_time desc")->limit(5)->select();
    	$this->assign("activityList",$activityList);
    	$Business = M('Business');
    	$businessList = $Business->order("create_time desc")->limit(5)->select();
    	$this->assign("businessList",$businessList);
        $this->display("index");

    }
    public function activity(){

        $id = I("get.id");
        $type = I("get.type");
        $Activity = M("activity");
        if(!empty($id)){
            if($type==2){
                $Activity = M("business");
            }
            $res = $Activity->where("id=$id")->find();
            $this->assign("res",$res);

            //previous next
            $previous = $Activity->where("id<$id")->order("id desc")->find();
            $after = $Activity->where("id>$id")->order("id asc")->find();
            $this->assign("previousRecord",$previous);
            $this->assign("afterRecord",$after);
        }

        $this->display("activity");
    }
    public function activitylist(){
        $this->assign("tab_type",3);
        $type = 1;
        $Activity = M("activity");
        $dbname = "chaoyangmall_activity";
        if(I("get.type")==2){
                $type = 2;
                $Activity = M("business");
                $dbname = "chaoyangmall_business";
        }
        //ss,num,
        $ss = 0;
        $ssRecord = 0;
        $num = 10;//一页展示的条数
        $totalpage = ceil($Activity->count()/$num);
        if(!empty(I("get.start"))){
            $ss = I("get.start");
            $ssRecord = ($ss-1)*$num;
            
        }
        $this->assign("currentPage",$ss);
        $this->assign("totalpage",$totalpage);
        $this->assign("num",$num);
        $activityList = $Activity->query("select * from $dbname LIMIT $ssRecord,$num");;
        $this->assign("activityList",$activityList);
        $this->assign("type",$type);
        $this->display();
    }

}