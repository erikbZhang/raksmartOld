<?php
namespace app\admin\controller;
use app\common\controller\Base;
use think\Controller;
use think\Cache;
use app\model\MArticleCat;
use app\model\MArticle;

class Article extends Base{

	public function __construct(){
		$user = session('user_info');
		if(!empty($user)) return redirect(url('admin/index/index'));
	}

	/**
	 * 列表
	 */
	public function index()
	{
		$cat_info = $this->getArticleCatInfo();;
		$data['cat_info'] = $cat_info;
		return view('',$data);
	}

	//获取数据
	public function getJsonData()
	{
		$page = input('get.page',1,'intval');
		$limit = input('get.limit',10,'intval');
		$keyword = input('get.keyword','','trim');
		$c_id = input('get.c_id','','trim');
		$where = [];
		$where['status'] = ['gt','-1'];
		$where['site'] = $this->getsessionbanben();//增加版本
		if(strlen($keyword)) $where['a_title'] = ['like',"%{$keyword}%"];
		if(!empty($c_id)){
			//查询子集
			$map['pid'] = $c_id;
			$ziji = MArticleCat::getSelect($map);
			$ziji_ids = array_column($ziji,'c_id');
			$ziji_ids[] = $c_id;
			$where['c_id'] = ['in',$ziji_ids];
		} //$where['c_id'] = $c_id;
		//获取列表数据
		$res = MArticle::getListPage($where,[],$page,$limit,'a_id desc');
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
		$cat_info = MArticleCat::getArticleCatList();
		$cat = array_column($cat_info,'c_name','c_id');
		foreach ($data as $k=>$item) {
			$data[$k]['a_addtime'] = !empty($item['a_addtime'])?date('Y-m-d H:i',$item['a_addtime']):'';
			$data[$k]['a_updatetime'] = !empty($item['a_updatetime'])?date('Y-m-d H:i',$item['a_updatetime']):'';
			//获取上级分类id
			$map['c_id'] = $item['c_id'];
			$c_id_info = MArticleCat::getDetail($map,'pid,c_name');
			if(!empty($c_id_info['pid'])){
				$map_b['c_id'] = $c_id_info['pid'];
				$pid_info = MArticleCat::getDetail($map_b,'c_name');
				$pid_name = $pid_info['c_name'].'--';
			}else{$pid_name = '';}

			$data[$k]['c_id_name'] = !empty($cat[$item['c_id']])?$pid_name.$cat[$item['c_id']]:'';
		}
		return $data;
	}

	//获取文章分类
	public function getArticleCatInfo()
	{
		$map['status'] = 1;
		$map['pid'] = 0;
		$map['site'] = $this->getsessionbanben();//增加版本
		$data = MArticleCat::getSelect($map);
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

	//新增
	public function add()
	{
		$data['cat_list'] = $this->getArticleCatInfo();//MArticleCat::getArticleCatList();//获取文章分类
		return view('',$data);
	}
	//提交添加
	public function submitdata()
	{
		$input = input();
		$c_id 	  = input('c_id','','intval');
		$title 	  = input('title','','trim');
		$con 	  = input('con','','trim');
		$content = input('content','','trim');
		$a_url = input('a_url','','trim');
		$a_type = input('a_type','','trim');
		$description = input('description','','trim');
		$img_url = input('img_url','','trim');
		$check[] = ['action'=>'string','value'=>$c_id];
		$check[] = ['action'=>'string','value'=>$title];
		$check[] = ['action'=>'string','value'=>$content];
		check($check);
		//验证提交的数据
		$add['c_id']  		= $c_id;
		$add['a_title']  	= $title;
		$add['a_con']  	= $con;
		$add['a_img']  		= $img_url;
		$add['a_imgs']  	= isset($input['photo']) && is_array($input['photo'])?json_encode(array_values($input['photo'])):'';
		$add['a_introduction'] 	= $description;
		$add['a_content'] 	= $content;
		$add['a_url'] 	= $a_url;
		$add['a_type'] = $a_type;
		$add['a_addtime'] 	= $add['a_updatetime'] = time();
		$add['site'] = $this->getsessionbanben();//增加版本
		$res = MArticle::toAdd($add);
		ajax_cms($res);
	}
	//编辑
	public function edit()
	{
		$id = input('id');
		if(empty($id)){ ajax_cms([],'参数错误');exit;}
		$where['a_id'] = $id;
		$data['info'] = MArticle::getDetail($where);
		$data['cat_list'] = $this->getArticleCatInfo();//MArticleCat::getArticleCatList();//获取文章分类
		return view('edit',$data);
	}
	//提交编辑
	public function submitedit()
	{
		$where = [];
		$input = input();
		$a_id 	  = input('a_id','','intval');
		$c_id 	  = input('c_id','','intval');
		$title 	  = input('title','','trim');
		$con 	  = input('con','','trim');
		$content = input('content','','trim');
		$a_url = input('a_url','','trim');
		$a_type = input('a_type','','trim');
		$description = input('description','','trim');
		$img_url = input('img_url','','trim');
		$check[] = ['action'=>'string','value'=>$c_id];
		$check[] = ['action'=>'string','value'=>$title];
		$check[] = ['action'=>'string','value'=>$content];
		check($check);
		//验证提交的数据
		$where['a_id'] 	= $a_id;
		//验证提交的数据
		$up['c_id']  		= $c_id;
		$up['a_title']  	= $title;
		$up['a_con']  	= $con;
		$up['a_img']  		= $img_url;
		$up['a_imgs']  	= isset($input['photo']) && is_array($input['photo'])?json_encode(array_values($input['photo'])):'';
		$up['a_introduction'] 	= $description;
		$up['a_content'] 	= $content;
		$up['a_url'] 	= $a_url;
		$up['a_type'] 	= $a_type;
		$up['a_updatetime'] = time();
		$res = MArticle::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
		ajax_cms(false,'保存失败');
	}

	//删除
	public function remove()
	{
		$id = input('id');
		if(empty($id)) ajax_cms(false);
		$where['a_id'] = $id;
		$up['status'] = '-1';
		$res = MArticle::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
		ajax_cms(false,'保存失败');
	}
}