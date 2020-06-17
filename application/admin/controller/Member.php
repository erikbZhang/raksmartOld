<?php 
namespace app\admin\controller;
use think\Controller;
use think\Cache;
use app\model\MMember;

class Member extends Controller{


    /**
	 * 用户列表 
	 */
	public function index()
	{
		return view('index');
	}
	
	//获取数据
	public function getJsonData()
	{
		$return = ['msg'=>'success','code'=>0,'data'=>[],'count'=>0];
		$page = $_GET['page'];
		$limit = $_GET['limit'];
		$where = $this->getWhere();
		$where['status'] = ['neq','-1'];
		//获取小区列表数据
		$res = MMember::getListPage($where,[],$page,$limit);
		if($res) $res = $res->toarray();
		if(!empty($res['data'])){
			$return['count'] = $res['total'];
			$return['data'] = $this->clData($res['data']);
		}else{
			$return = ['msg'=>'数据为空','code'=>1,'data'=>[]];
		}
		exit(json_encode($return));
	}

	//处理筛选信息
	public function getWhere()
	{
		$where = [];
		if(!empty($_GET['m_phone'])) $where['m_phone'] = ['like','%'.$_GET['m_phone'].'%'];
		if(!empty($_GET['m_name'])) $where['m_name'] = ['like','%'.$_GET['m_name'].'%'];
		return $where;
	}
	
	//处理列表信息
	public function clData($data)
	{
		if(empty($data)) return [];
		foreach($data as $k=>$v){
			if($v['status'] == 0)
                $v['status_name'] = '<button onclick="qjyong('.$v['status'].',`'.$v['m_id'].'`)"  class="layui-btn layui-btn-xs" title="点击启用">点击启用</button>';
			else $v['status_name'] = '<button onclick="qjyong('.$v['status'].',`'.$v['m_id'].'`)" class="layui-btn layui-btn-primary layui-btn-xs" title="点击禁用">点击禁用</button>';
			$v['addtime'] = (!empty($v['addtime']))?date('Y-m-d H:i',$v['addtime']):'';
			$data[$k] = $v;
		}
		return $data;
	}
	
	//添加账号
	public function add()
	{
		return view('add');
	}
	
	//提交数据
	public function submitdata()
	{
		$data = $_POST;
		//验证提交的数据
		$this->yzSubmintData($data);
		$add['m_id'] = create_id();
		$add['m_account'] = $data['m_account'];
		$add['m_password'] = password($data['password']);
		$add['m_phone'] = $data['m_phone'];
		$add['m_name'] = $data['m_name'];
		$add['status'] = 1;
		$add['addtime'] = time();
		$res = MMember::toAdd($add);
		ajax_cms($res);
	}
	
	//验证提交的数据
	public function yzSubmintData($data)
	{
		if(empty($data['password']) || empty($data['passwordtwo']))  ajax_cms([],'两次密码不一致');
		//账号不可以重复
		$map['m_account'] = $data['m_account'];
		$map['status'] = ['neq','-1'];
		$count = MMember::toCount($map);
		if($count > 0){
			ajax_cms(false,'该账号已经存在,请选择其他的账号名称');
		}
	}
	
	//edit
	public function edit()
	{
		$m_id = $_GET['m_id'];
		if(empty($m_id)) ajax_cms([],'参数错误');
		
		$where['m_id'] = $m_id;
		$info = MMember::getInfo($where);
		return view('edit',$info);
	}
	//submitedit
	public function submitedit()
	{
		$data = $_POST;
		if(empty($data['m_id'])) ajax_cms([],'参数错误');
		
		if(!empty($data['password'])) $up['password'] = password($data['password']);
		$up['m_phone'] = $data['m_phone'];
		$up['m_name'] = $data['m_name'];
		$where['m_id'] = $data['m_id'];
		$res = MMember::toUpdate($where,$up);
		if($res !== false){
			ajax_cms($res);
		}else{
			ajax_cms(false,'保存失败');
		}	
	}
	
	//改变状态
	public function changestatus()
	{
		$up['status'] = 0;
		$status = $_POST['status'];
		$m_id = $_POST['m_id'];
		if($status == 0) $up['status'] = 1;
		$where['m_id'] = $m_id;
		$res = MMember::toUpdate($where,$up);
		ajax_cms($res);
	}
    //删除
	public function delete()
    {
		$m_id = input('m_id');
		if(empty($m_id)) { ajax_cms(false);exit;}
		$where['m_id'] = $m_id;
		$up['status'] = '-1';
		$res = MMember::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
		ajax_cms(false,'操作失败');
    }


}