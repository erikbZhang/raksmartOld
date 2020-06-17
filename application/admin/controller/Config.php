<?php 
namespace app\admin\controller;
use app\common\controller\Base;
use think\Controller;
use think\Cache;
use app\model\MConfig;

class Config extends Base{

    public function __construct(){
        $user = session('user_info');
        if(!empty($user)) return redirect(url('admin/index/index'));
    }

	public function index()
	{
		return view('index',[]);
	}
	public function getJsonData()
	{
		$return = ['msg'=>'success','code'=>0,'data'=>[],'count'=>0];
		$page = $_GET['page'];
		$limit = $_GET['limit'];
		$where = [];
		$where['site'] = $this->getsessionbanben();//增加版本
		//获取列表数据
		$res = MConfig::getListPage($where,[],$page,$limit);
		if($res) $res = $res->toarray();
		if(!empty($res['data'])){
			$return['count'] = $res['total'];
			$return['data'] = ($res['data']);
		}else{
			$return = ['msg'=>'数据为空','code'=>1,'data'=>[]];
		}
		exit(json_encode($return));
	}

	/*
	 * 修改
	 * */
	public function editNet()
	{
		$id = input('id');
		if(empty($id)){ ajax_cms([],'参数错误');exit;}
		$where['id'] = $id;
		$data['info'] = MConfig::getDetail($where);
		return view('edit',$data);
	}

	/*
	 * 保存
	 * */
	public function submitedit()
	{
		$where = [];
		$data = input();
		$check[] = ['action'=>'string','value'=>$data['id']];
		check($check);
		//验证提交的数据
		$where['id'] = $data['id'];
		$up['value']   = $data['value'];
		$res = MConfig::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
		ajax_cms(false,'保存失败');
	}


	
	
	
	
}