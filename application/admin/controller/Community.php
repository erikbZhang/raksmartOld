<?php 
namespace app\admin\controller;
use think\Controller;
use app\common\controller\Base;
use app\model\MCommunity;
use app\model\MCompany;

class Community extends Base{


	//社区管理列表
	public function index()
	{
		$data['config_jindu'] = config('progress');
		$data['company_list'] = MCompany::getCompanySelect(['status'=>1]);
		return view('index',$data);
	}
	
	//获取数据json
	public function getJsonData()
	{
		$return = ['msg'=>'success','code'=>0,'data'=>[],'count'=>0];
		$page = $_GET['page'];
		$limit = $_GET['limit'];
		$where = $this->getWhere();
		//获取小区列表数据
		$res = MCommunity::getCommunityPage($where,[],$page,$limit);
		if($res) $res = $res->toarray();
		if(!empty($res['data'])){
			//获取车位数
			$res['data'] = $this->getCartNum($res['data']);
			$return['count'] = $res['total'];
			$return['data'] = ($res['data']);
		}else{
			$return = ['msg'=>'数据为空','code'=>1,'data'=>[]];
		}
		exit(json_encode($return));
	}
	
	//获取处理车位数
	public function getCartNum($data)
	{
		$community_ids = array_column($data,'community_id');
		$map['community_id'] = ['in',$community_ids];
		$map['status'] = ['neq','-1'];
		$res = MCommunity::getPartNum($map,'community_id',['community_id','count(*) as count']);
		if(!empty($res)){
			$array = array_column($res,'count','community_id');
		}
		$config_jindu = config('progress');
		$company_list = MCompany::getCompanySelect(['status'=>1]);
		$company_list = array_column($company_list,'company_name','id');
		foreach($data as $kk=>$vv){
			$data[$kk]['num'] = (!empty($array[$vv['community_id']]))?$array[$vv['community_id']]:0;
			$data[$kk]['property_name'] = MCommunity::getPropertyValue(['property_id'=>$vv['property_id']],'property_name');
			$data[$kk]['start_time'] =  (!empty($vv['start_time']))?date('Y-m-d',$vv['start_time']):'';
			$data[$kk]['end_time'] = (!empty($vv['end_time']))?date('Y-m-d',$vv['end_time']):'';
			$data[$kk]['type_name'] = (!empty($config_jindu[$vv['type']]))?$config_jindu[$vv['type']]:'';
			$data[$kk]['status_name'] = ($vv['status'] == 2)?'<span style="color:red;">是</span>':'否';
			$data[$kk]['company_name'] = (!empty($company_list[$vv['company_id']]))?$company_list[$vv['company_id']]:'';
		}
		return $data;
	}
	
	//处理筛选信息
	public function getWhere()
	{
		$where = [];
		//$where['status'] = 1;//正常
		if(!empty($_GET['community_name'])) $where['community_name'] = ['like','%'.$_GET['community_name'].'%'];
		if(!empty($_GET['sale_name'])) $where['sale_name'] = ['like','%'.$_GET['sale_name'].'%'];
		if(!empty($_GET['tab'])){
			if($_GET['tab'] == 222){//合作终止
				$where['status'] = 2;//合作作废
			}else if($_GET['tab'] == 111){//即将到期  一年内到期
				$time = time();
				$year =  strtotime("+1 year"); 
				$where['end_time'] = ['between time' ,[$time,$year] ];
			}else{
				$where['type'] = $_GET['tab'];
			}
		}
		if(!empty($_GET['record_no'])) $where['record_no'] = $_GET['record_no'];
		
		if(!empty($_GET['start_time']) && !empty($_GET['end_time'])){
			$where['start_time'] = ['egt',strtotime($_GET['start_time'])];
			if(!empty($_GET['tab']) && $_GET['tab'] == 111){
				$where['end_time'] = ['between time',[time(),strtotime($_GET['end_time'])]];
			}else{
				$where['end_time'] = ['elt',strtotime($_GET['end_time'])];
			}
		}
		if(!empty($_GET['start_time'])) $where['start_time'] = ['egt',strtotime($_GET['start_time'])];
		if(!empty($_GET['end_time'])) {
			if(!empty($_GET['tab']) && $_GET['tab'] == 111){
				$where['end_time'] = ['between time',[time(),strtotime($_GET['end_time'])]];
			}else{
				$where['end_time'] = ['elt',strtotime($_GET['end_time'])];
			}
		}
		if(!empty($_GET['company_id'])) $where['company_id'] = $_GET['company_id'];
		//print_r($where);
		return $where;
	}
	
	//获取数据详情
	public function details()
	{
		$data = [];
		$community_id = $_GET['community_id'];
		$map['community_id'] = $community_id;
		$data['record'] = MCommunity::getCommunityInfo(['community_id'=>$community_id]);
		$data['extend'] = MCommunity::getExtendFind(['community_id'=>$community_id]);
		
		$map['status'] = ['neq','-1'];
		$data['park_num_count'] = MCommunity::getParkNumCount($map);//获取车位数
		
		$where['p_community_id'] = $community_id;
		$where['status'] = ['neq','-1'];
		$data['estate_count'] = MCommunity::getCommunityEstate($where);//获取房产数
		
		$con['property_id'] = $data['record']['property_id'];
		$data['property_info'] = MCommunity::getPropertyInfo($con);//获取物业信息
		if(!empty($data['extend']['contract_photo'])){
			$data['img'] = explode(',',$data['extend']['contract_photo']);
		}
		if(!empty($data['extend']['device_photo'])){
			$data['img_two'] = explode(',',$data['extend']['device_photo']);
		}
		$data['progress_array'] = (!empty($data['record']['type']))?explode(',',$data['record']['type']):[]; 
		$data['record']['start_time'] = (!empty($data['record']['start_time']))?date('Y-m-d',$data['record']['start_time']):'';
		$data['record']['end_time'] = (!empty($data['record']['end_time']))?date('Y-m-d',$data['record']['end_time']):'';
		//获取进度
		$data['config_jindu'] = config('progress');
		//获取公司列表
		$data['company_list'] = MCompany::getCompanySelect(['status'=>1]);
		return view('details',$data);
	}
	
	//提交数据
	public function submitdata()
	{
		$data = $_POST;
		if(empty($data['community_id'])){
			echo json_encode(['code'=>'00','message'=>'参数错误']);exit;
		}
		$up['record_no'] = $data['record_no'];
		$up['linkman'] = $data['linkman'];
		$up['mobile'] = $data['mobile'];
		$up['sale_name'] = $data['sale_name'];
		$up['type'] = (!empty($data['type']))?$data['type']:'';
		$up['start_time'] = strtotime($data['start_time']);
		$up['end_time'] = strtotime($data['end_time']);
		$up['company_id'] = $data['company_id'];
		$up['update_time'] = time();
		$where['community_id'] = $data['community_id'];
		$up_e['contract_photo'] = $up_e['device_photo'] = '';
		$up_e['device_num'] = $data['device_num'];
		if(!empty($data['img']))$up_e['contract_photo'] = implode($data['img'],',');
		if(!empty($data['img_two']))$up_e['device_photo'] = implode($data['img_two'],',');
		$up_e['remark'] = $data['remark'];
		
		$where['community_id'] = $data['community_id'];
		$count = MCommunity::getRecordCount($where);
		$count_e = MCommunity::getExtendCount($where);
		if($count > 0 && $count_e > 0){//update
			$res = MCommunity::getRecordUpdate($where,$up);
		}else{//add
			$up['community_id'] = $data['community_id'];
			$up['create_time'] = time();
			$res = MCommunity::getRecordAdd($up);
		}
		if($count_e > 0){//update
			$res_e = MCommunity::getExtendUpdate($where,$up_e);
		}else{//add
			$up_e['community_id'] = $data['community_id'];
			$res_e = MCommunity::getExtendAdd($up_e);
		}
		if($res !== false){
			$msg['code'] = 200;
		}else{
			$msg['code'] = 111;
		}
		echo json_encode($msg);
	}
	
	//地图设置
	public function ditu()
	{
		$data = [];
		$community_id = $_GET['community_id'];
		$map['community_id'] = $community_id;
		$data['extend'] = MCommunity::getExtendFind(['community_id'=>$community_id]);
		
		return view('map',$data);
	}
	//提交地图设置
	public function submitmap()
	{
		$data = $_POST;
		if(empty($data['community_id']) || empty($data['address'])){
			echo json_encode(['code'=>'00','message'=>'参数错误']);exit;
		}
		$up['address'] = $data['address'];
		$up['longitude'] = $data['longitude'];
		$up['latitude'] = $data['latitude'];
		$where['community_id'] = $data['community_id'];
		
		$count_e = MCommunity::getExtendCount($where);
		if($count_e > 0){//update
			$res_e = MCommunity::getExtendUpdate($where,$up);
		}else{//add
			$up_e['community_id'] = $data['community_id'];
			$res_e = MCommunity::getExtendAdd($up);
		}
		if($res_e !== false){
			$msg['code'] = 200;
		}else{
			$msg['code'] = 111;
			$msg['message'] = '失败';
		}
		echo json_encode($msg);
	}
	
	//作废
	public function nullify()
	{
		$community_id = $_GET['community_id'];
		$map['community_id'] = $community_id;
		$up['status'] = 2;
		
		$count_e = MCommunity::getRecordCount($map);
		if($count_e == 0){
			$msg['code'] = 111;
			$msg['message'] = '作废失败';
			echo json_encode($msg);exit;
		}
		$res_e = MCommunity::getRecordUpdate($map,$up);
		if($res_e !== false){
			$msg['code'] = 200;
		}else{
			$msg['code'] = 111;
			$msg['message'] = '失败';
		}
		echo json_encode($msg);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	

}