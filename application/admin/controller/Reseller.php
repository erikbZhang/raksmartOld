<?php 
namespace app\admin\controller;
use app\common\controller\Base;
use think\Controller;
use think\Cache;
use app\model\MReseller;

class Reseller extends Base{

    public function __construct(){
        $user = session('user_info');
        if(!empty($user)) return redirect(url('admin/index/index'));
    }

	/**
	 * 列表 
	 */
	public function index()
	{
		$data['reseller_info'] = lang('reseller_info');
		return view('index',$data);
	}
	
	//获取数据
	public function getJsonData()
	{
		$return = ['msg'=>'success','code'=>0,'data'=>[],'count'=>0];
		$page = $_GET['page'];
		$limit = $_GET['limit'];
		$where = $this->getWhere();
		$where['site'] = $this->getsessionbanben();//增加版本
		//获取列表数据
		$res = MReseller::getListPage($where,[],$page,$limit);
		if($res) $res = $res->toarray();
		if(!empty($res['data'])){
			$return['count'] = $res['total'];
			$return['data'] = $res['data'];
		}else{
			$return = ['msg'=>'数据为空','code'=>1,'data'=>[]];
		}
		exit(json_encode($return));
	}
	public function getWhere()
	{
		$where = [];
		$r_type       = input('get.r_type','','trim');
		if(!empty($r_type)) $where['r_type'] = ['like','%'.$r_type.'%'];
		return $where;
	}
	
	//新增
	public function addNet()
	{
		$data['reseller_info'] = lang('reseller_info');
		return view('add',$data);
	}
	//提交添加
	public function submitdata()
	{
		$data = input();
        $check[] = ['action'=>'string','value'=>$data['r_type']];
        $check[] = ['action'=>'string','value'=>$data['r_money']];
        check($check);
		//验证提交的数据
        $add['r_type'] = $data['r_type'];
        $add['r_money'] = $data['r_money'];
        $add['r_zhe'] = $data['r_zhe'];
        $add['r_resource'] = $data['r_resource'];
        $add['r_zc'] = $data['r_zc'];
        $add['r_server'] = $data['r_server'];
		$add['site'] = $this->getsessionbanben();//增加版本
		$res = MReseller::toAdd($add);
		ajax_cms($res);
	}
	//编辑
	public function editNet()
	{
		$id = input('id');
		if(empty($id)){ ajax_cms([],'参数错误');exit;}
		$where['id'] = $id;
		$data['info'] = MReseller::getDetail($where);
		$data['reseller_info'] = lang('reseller_info');
		return view('edit',$data);
	}
	//提交编辑
	public function submitedit()
	{
		$where = [];
		$data = input();
        $check[] = ['action'=>'string','value'=>$data['id']];
        $check[] = ['action'=>'string','value'=>$data['r_type']];
        $check[] = ['action'=>'string','value'=>$data['r_money']];
        check($check);
        //验证提交的数据
        $where['id'] = $data['id'];
        $up['r_type']   = $data['r_type'];
		$up['r_money'] = $data['r_money'];
		$up['r_zhe'] = $data['r_zhe'];
		$up['r_resource'] = $data['r_resource'];
		$up['r_zc'] = $data['r_zc'];
		$up['r_server'] = $data['r_server'];
		$res = MReseller::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	
	//删除
	public function deleteNet()
	{
		$id = input('id');
		if(empty($id)) { ajax_cms(false);exit;}
		$where['id'] = $id;
		$res = MReseller::toDelete($where);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	
	
	
	
	
	
	
}