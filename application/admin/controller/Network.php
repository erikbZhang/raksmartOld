<?php 
namespace app\admin\controller;
use app\common\controller\Base;
use think\Controller;
use think\Cache;
use app\model\MNetwork;

class Network extends Base{

    public function __construct(){
        $user = session('user_info');
        if(!empty($user)) return redirect(url('admin/index/index'));
    }

	/**
	 * 列表 
	 */
	public function index()
	{
		$data['type_network'] = lang('type_network');
		return view('index',$data);
	}
	
	//获取数据
	public function getJsonData()
	{
		$return = ['msg'=>'success','code'=>0,'data'=>[],'count'=>0];
		$page = $_GET['page'];
		$limit = $_GET['limit'];
		$where = $this->getWhere();
		$where['status'] = ['gt','-1'];
		$where['site'] = $this->getsessionbanben();//增加版本
		//获取列表数据
		$res = MNetwork::getListPage($where,[],$page,$limit);
		if($res) $res = $res->toarray();
		if(!empty($res['data'])){
			$return['count'] = $res['total'];
			$return['data'] = $this->clData($res['data']);
		}else{
			$return = ['msg'=>'数据为空','code'=>1,'data'=>[]];
		}
		exit(json_encode($return));
	}
	//处理列表信息
	public function clData($data)
	{
		if(empty($data)) return [];
		$type_network = lang('type_network');
        foreach ($data as $k=>$item) {
			$name = '';
            if(!empty($item['w_operator'])){
				$w_operator = explode(',',$item['w_operator']);
				foreach($w_operator as $kk=>$v){
					$name .= (!empty($type_network[$v]))?$type_network[$v].',':'';
				}
			}
			$data[$k]['w_operator_name'] = trim($name,',');
            $data[$k]['addtime'] = !empty($item['addtime'])?date('Y-m-d H:i',$item['addtime']):'';
        }
		return $data;
	}
	
	public function getWhere()
	{
		$where = [];
		$w_name       = input('get.w_name','','trim');
		$w_operator    = input('get.w_operator','','trim');
		if(!empty($w_name)) $where['w_name'] = ['like','%'.$w_name.'%'];
		if(!empty($w_operator)) $where['w_operator'] = ['like','%'.$w_operator.'%'];
		return $where;
	}
	
	//新增
	public function addNet()
	{
		$data['type_network'] = lang('type_network');
		return view('add_net',$data);
	}
	//提交添加
	public function submitdata()
	{
		$data = input();
        $check[] = ['action'=>'string','value'=>$data['w_name']];
        $check[] = ['action'=>'string','value'=>$data['w_ip']];
        check($check);
		//验证提交的数据
        $add['w_name'] = $data['w_name'];
        $add['w_ip'] = $data['w_ip'];
        $add['w_url'] = $data['w_url'];
        $add['w_operator'] = implode($data['w_operator'],',');
		$add['addtime'] = time();
		$add['status'] = 1;
		$add['site'] = $this->getsessionbanben();//增加版本
		$res = MNetwork::toAdd($add);
		ajax_cms($res);
	}
	//编辑
	public function editNet()
	{
		$id = input('id');
		if(empty($id)){ ajax_cms([],'参数错误');exit;}
		$where['id'] = $id;
		$data['info'] = MNetwork::getDetail($where);
		if(!empty($data['info']['w_operator'])) $data['info']['w_operator'] = explode(',',$data['info']['w_operator']);
		$data['type_network'] = lang('type_network');
		return view('edit_net',$data);
	}
	//提交编辑
	public function submitedit()
	{
		$where = [];
		$data = input();
        $check[] = ['action'=>'string','value'=>$data['id']];
        $check[] = ['action'=>'string','value'=>$data['w_name']];
        $check[] = ['action'=>'string','value'=>$data['w_ip']];
        check($check);
        //验证提交的数据
        $where['id'] = $data['id'];
        $up['w_name']   = $data['w_name'];
        $up['w_ip'] = $data['w_ip'];
        $up['w_url'] = $data['w_url'];
        $up['w_operator'] = implode($data['w_operator'],',');
		$up['addtime'] = time();
		$res = MNetwork::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	
	//删除
	public function deleteNet()
	{
		$id = input('id');
		if(empty($id)) { ajax_cms(false);exit;}
		$where['id'] = $id;
		$up['status'] = '-1';
		$res = MNetwork::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	
	
	
	
	
	
	
}