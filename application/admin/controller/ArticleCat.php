<?php
namespace app\admin\controller;
use app\common\controller\Base;
use think\Controller;
use think\Cache;
use app\model\MArticleCat;

class ArticleCat extends Base{

	public function __construct(){
		$user = session('user_info');
		if(!empty($user)) return redirect(url('admin/index/index'));
	}

	/**
	 * 列表
	 */
	public function index()
	{
		return view();
	}

	//获取数据
	public function getJsonData()
	{
		$page = input('get.page',1,'intval');
		$limit = input('get.limit',10,'intval');
		$keyword = input('get.c_name','','trim');
		$where = [];
		$where['status'] = ['gt','-1'];
		$where['pid'] = 0;
		$where['site'] = $this->getsessionbanben();//增加版本
		if(strlen($keyword)) $where['c_name'] = ['like',"%{$keyword}%"];
		//获取列表数据
		$res = MArticleCat::getListPage($where,[],$page,$limit,'listorder asc,c_id desc');
		if($res) $res = $res->toarray();
		if(!empty($res['data'])){
			$data = $this->clData($res['data']);
			ajax_cms($data,lang('data_is_ok'),$res['total']);
		}
		ajax_cms(false,lang('data_is_empty'));
	}
	//处理列表信息
	public function clData($data)
	{
		if(empty($data)) return [];
		foreach ($data as $k=>$item) {
			$data[$k]['addtime'] = !empty($item['addtime'])?date('Y-m-d H:i',$item['addtime']):'';
			$where['status'] = 1;
			$where['pid'] = $item['c_id'];
			$info = MArticleCat::getSelect($where);
			if(!empty($info)){
				foreach($info as $kk=>$vv){
					$data[$k]['child'][] = $vv;
				}
			}
		}
		foreach($data as $kkk=>$vvv){
			$array[] = $vvv;
			if(!empty($vvv['child'])){
				foreach($vvv['child'] as $nn){
					$nn['c_name'] = '&nbsp;&nbsp;&nbsp;&nbsp;|---'.$nn['c_name'];
					$nn['addtime'] = !empty($nn['addtime'])?date('Y-m-d H:i',$nn['addtime']):'';
					$array[] = $nn;
				}

			}

		}
		return $array;
	}

	//获取所有一级分类
	public function getOneInfo()
	{
		$where['status'] = 1;
		$where['pid'] = 0;
		$where['site'] = $this->getsessionbanben();//增加版本
		$info = MArticleCat::getSelect($where);
		return $info;
	}

	//新增
	public function add()
	{
		$data['info'] = $this->getOneInfo();
		return view('',$data);
	}
	//提交添加
	public function submitdata()
	{
		$name 	  = input('c_name','','trim');
		$listorder = input('listorder',1,'intval');
		$check[] = ['action'=>'string','value'=>$name];
		check($check);
		//验证提交的数据
		$add['c_name']  	= $name;
		$add['pid'] = input('pid',0,'intval');
		$add['listorder'] 	= $listorder;
		$add['addtime'] 	= $add['update_time'] = time();
		$add['site'] = $this->getsessionbanben();//增加版本
		$res = MArticleCat::toAdd($add);
		ajax_cms($res);
	}
	//编辑
	public function edit()
	{
		$id = input('id');
		if(empty($id)){ ajax_cms([],'参数错误');exit;}
		$where['c_id'] = $id;
		$data['info'] = MArticleCat::getDetail($where);
		$data['info_data'] = $this->getOneInfo();
		return view('edit',$data);
	}
	//提交编辑
	public function submitedit()
	{
		$where = [];
		$c_id 	  = input('c_id','0','intval');
		$name 	  = input('c_name','','trim');
		$listorder = input('listorder',1,'intval');
		$check[] = ['action'=>'string','value'=>$c_id];
		$check[] = ['action'=>'string','value'=>$name];
		check($check);
		//验证提交的数据
		$where['c_id'] 	= $c_id;
		$up['pid'] = input('pid',0,'intval');
		$up['c_name']   = $name;
		$up['listorder']= $listorder;
		$up['update_time']  = time();
		$res = MArticleCat::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
		ajax_cms(false,'保存失败');
	}

	//删除
	public function remove()
	{
		$id = input('id');
		if(empty($id)) ajax_cms(false);
		$where['c_id'] = $id;
		$info = MArticleCat::getDetail($where);
		if(isset($info['pid']) && $info['pid'] == 0){
			ajax_cms(false,'一级分类暂时不支持删除');
		}
		$up['status'] = '-1';
		$res = MArticleCat::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
		ajax_cms(false,'保存失败');
	}


}