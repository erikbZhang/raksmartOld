<?php 
namespace app\admin\controller;
use app\common\controller\Base;
use think\Controller;
use think\Cache;
use app\model\MPartner;
class Partner extends Base{

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
		$keyword = input('get.keyword','','trim');
		$where = [];
		if(strlen($keyword)) $where['title'] = ['like',"%{$keyword}%"];
		$where['site'] = $this->getsessionbanben();//增加版本
		//获取列表数据
		$res = MPartner::getListPage($where,[],$page,$limit,'listorder asc,id desc');
		if($res) $res = $res->toarray();
		if(!empty($res['data'])){
			$data = $this->clData($res['data']);
			ajax_cms($data,lang('datis_ok'),$res['total']);
		}
		ajax_cms(false,lang('data_is_empty'));
	}
	//处理列表信息
	public function clData($data)
	{
		if(empty($data)) return [];
		foreach ($data as $k=>$item) {
			$item['thumb'] = (!empty($item['thumb']))?"<a href='/uploads/".$item['thumb']."' target='_blank' title='点击查看'><img src='/uploads/".$item['thumb']."'/></a>":'';
			$item['addtime'] = !empty($item['addtime'])?date('Y-m-d H:i',$item['addtime']):'';
			$data[$k] = $item;
		}
		return $data;
	}

	//新增
	public function add()
	{
		return view();
	}
	//提交添加
	public function submitdata()
	{
		$input = input();
		$title 	  = input('title','','trim');
		$description = input('description','','trim');
		$thumb 		 = input('thumb','','trim');
		$listorder	 = input('listorder','0','intval');
		$check[] = ['action'=>'string','value'=>$title];
		check($check);
		//验证提交的数据
		$add['title']  		= $title;
		$add['thumb']  		= $thumb;
		$add['description'] = $description;
		$add['listorder']   = $listorder;
		$add['addtime'] 	= $add['updatetime'] = time();
		$add['site'] = $this->getsessionbanben();//增加版本
		$res = MPartner::toAdd($add);
		ajax_cms($res);
	}
	//编辑
	public function edit()
	{
		$id = input('id');
		if(empty($id)){ ajax_cms([],'参数错误');exit;}
		$where['id'] = $id;
		$data['info'] = MPartner::getDetail($where);
		return view('edit',$data);
	}
	//提交编辑
	public function submitedit()
	{
		$where = [];
		$input = input();
		$id 	  = input('id','','intval');
		$title 	  = input('title','','trim');
		$description = input('description','','trim');
		$thumb 		 = input('thumb','','trim');
		$listorder	 = input('listorder','0','intval');
		$check[] = ['action'=>'string','value'=>$id];
		$check[] = ['action'=>'string','value'=>$title];
		check($check);
		//验证提交的数据
		$where['id'] 	= $id;
		$up['title']  	= $title;
		$up['thumb']  		= $thumb;
		$up['description'] 	= $description;
		$up['listorder'] 	= $listorder;
		$up['updatetime'] = time();
		$res = MPartner::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
		ajax_cms(false,'保存失败');
	}

	//删除
	public function remove()
	{
		$id = input('id');
		if(empty($id)) ajax_cms(false);
		$where['id'] = $id;
		$res = MPartner::toDelete($where);
		if($res !== false) ajax_cms(true);
		ajax_cms(false,'保存失败');
	}
	//排序
	public function sort()
	{
		$id = input('id');
		$value = input('value','','trim');
		$field = input('field','','trim');
		if(empty($id) || empty($field)) ajax_cms(false);
		$where['id'] = $id;
		$update[$field] = $value;
		$update['updatetime'] = time();
		$res = MPartner::toUpdate($where,$update);
		if($res !== false) ajax_cms(true);
		ajax_cms(false,'保存失败');
	}
}