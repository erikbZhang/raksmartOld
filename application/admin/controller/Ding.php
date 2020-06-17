<?php 
namespace app\admin\controller;
use app\common\controller\Base;
use think\Controller;
use think\Cache;
use app\model\MDictionaries;
use app\model\MDing;

class Ding extends Base{

    public function __construct(){
        $user = session('user_info');
        if(!empty($user)) return redirect(url('admin/index/index'));
    }

	/**
	 * 列表 
	 */
	public function dic()
	{
		$site = $this->getsessionbanben();
		if($site == 1){
			$a = 'type_dictionaries';
		}else{
			$a = 'type_dictionaries_en';
		}
		$data['type_dictionaries'] = lang($a);
		return view('dic',$data);
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
		$res = MDictionaries::getListPage($where,[],$page,$limit);
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
		$site = $this->getsessionbanben();
		if($site == 1){
			$a = 'type_dictionaries';
		}else{
			$a = 'type_dictionaries_en';
		}
		$type_dictionaries = lang($a);
        foreach ($data as $k=>$item) {
            $item['type_name'] = !empty($type_dictionaries[$item['type']])?$type_dictionaries[$item['type']]:'';
            $data[$k] = $item;
        }
		return $data;
	}
	
	public function getWhere()
	{
		$where = [];
		$name       = input('get.name','','trim');
		$type    = input('get.type','','trim');
		if(!empty($name)) $where['name'] = ['like','%'.$name.'%'];
		if(!empty($type)) $where['type'] = $type;
		return $where;
	}
	
	//新增
	public function addDic()
	{
		$site = $this->getsessionbanben();
		if($site == 1){
			$a = 'type_dictionaries';
		}else{
			$a = 'type_dictionaries_en';
		}
		$data['type_dictionaries'] = lang($a);
		return view('add_dic',$data);
	}
	//提交添加
	public function submitdata()
	{
		$data = input();
        $check[] = ['action'=>'string','value'=>$data['name']];
        $check[] = ['action'=>'string','value'=>$data['type']];
        check($check);
		//验证提交的数据
        $add['name'] = $data['name'];
        $add['type'] = $data['type'];
		$add['site'] = $this->getsessionbanben();//增加版本
		$res = MDictionaries::toAdd($add);
		ajax_cms($res);
	}
	//编辑
	public function editDic()
	{
		$id = input('id');
		if(empty($id)){ ajax_cms([],'参数错误');exit;}
		$where['id'] = $id;
		$data['info'] = MDictionaries::getDetail($where);
		$site = $this->getsessionbanben();
		if($site == 1){
			$a = 'type_dictionaries';
		}else{
			$a = 'type_dictionaries_en';
		}
		$data['type_dictionaries'] = lang($a);
		return view('edit_dic',$data);
	}
	//提交编辑
	public function submitedit()
	{
		$where = [];
		$data = input();
        $check[] = ['action'=>'string','value'=>$data['id']];
        $check[] = ['action'=>'string','value'=>$data['name']];
        check($check);
        //验证提交的数据
        $where['id'] = $data['id'];
        $up['name']   = $data['name'];
        $up['type']   = $data['type'];
		$res = MDictionaries::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	
	//删除
	public function deletedic()
	{
		$id = input('id');
		if(empty($id)) { ajax_cms(false);exit;}
		$where['id'] = $id;
		$up['status'] = '-1';
		$res = MDictionaries::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	
	
	//定制服务器列表数据
	public function ding()
	{
		$data = [];
		return view('ding',$data);
	}
	public function getJsonDataDing()
	{
		$return = ['msg'=>'success','code'=>0,'data'=>[],'count'=>0];
		$page = $_GET['page'];
		$limit = $_GET['limit'];
		$where = $this->getWhereDing();
		$where['status'] = ['gt','-1'];
		$where['site'] = $this->getsessionbanben();//增加版本
		//获取列表数据
		$res = MDing::getListPage($where,[],$page,$limit);
		if($res) $res = $res->toarray();
		if(!empty($res['data'])){
			$return['count'] = $res['total'];
			$return['data'] = $this->clDataDing($res['data']);
		}else{
			$return = ['msg'=>'数据为空','code'=>1,'data'=>[]];
		}
		exit(json_encode($return));
	}
	public function clDataDing($data)
	{
		if(empty($data)) return [];
        foreach ($data as $k=>$item) {
            $item['addtime'] = !empty($item['addtime'])?date('Y-m-d H:i',$item['addtime']):'';
            $data[$k] = $item;
        }
		return $data;
	}
	public function getWhereDing()
	{
		$where = [];
		$d_country       = input('get.d_country','','trim');
		$d_cpu    = input('get.d_cpu','','trim');
		$d_nc    = input('get.d_nc','','trim');
		$d_ip    = input('get.d_ip','','trim');
		if(!empty($d_country)) $where['d_country'] = ['like','%'.$d_country.'%'];
		if(!empty($d_cpu)) $where['d_cpu'] = $d_cpu;
		if(!empty($d_nc)) $where['d_nc'] = $d_nc;
		if(!empty($d_ip)) $where['d_ip'] = $d_ip;
		return $where;
	}
	//删除
	public function deleteding()
	{
		$id = input('id');
		if(empty($id)) { ajax_cms(false);exit;}
		$where['id'] = $id;
		$up['status'] = '-1';
		$res = MDing::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	
	
	
	
	
}