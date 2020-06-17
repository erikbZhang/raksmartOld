<?php 
namespace app\admin\controller;
use app\common\controller\Base;
use think\Controller;
use think\Cache;
use app\model\MMessage;

class Message extends Base{

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
		$where = $this->getWhere();
		$where['site'] = $this->getsessionbanben();//增加版本
		//获取列表数据
		$res = MMessage::getListPage($where,[],$page,$limit);
		if($res) $res = $res->toarray();
		if(!empty($res['data'])){
			$return['count'] = $res['total'];
			$return['data'] = $this->clDataP($res['data']);
		}else{
			$return = ['msg'=>'数据为空','code'=>1,'data'=>[]];
		}
		exit(json_encode($return));
	}
	public function clDataP($data)
	{
		if(empty($data)) return [];
        foreach ($data as $k=>$item) {
            $item['addtime'] = !empty($item['addtime'])?date('Y-m-d',$item['addtime']):'';
            $data[$k] = $item;
        }
		return $data;
	}
	public function getWhere()
	{
		$where = [];
		$name       = input('get.name','','trim');
		if(!empty($name)) $where['name'] = ['like','%'.$name.'%'];
		return $where;
	}
	//删除
	public function deleteMessage()
	{
		$id = input('id');
		if(empty($id)) { ajax_cms(false);exit;}
		$where['id'] = $id;
		$res = MMessage::toDelete($where);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	
	
	
	
}