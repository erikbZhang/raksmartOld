<?php 
namespace app\admin\controller;
use app\common\controller\Base;
use think\Controller;
use think\Cache;
use app\model\MArea;
use app\model\MProduct;

class Luoji extends Base{

    public function __construct(){
        $user = session('user_info');
        if(!empty($user)) return redirect(url('admin/index/index'));
    }

	/**
	 * 地区列表 
	 */
	public function area()
	{
		$data['type'] = input('type')?:1;
		return view('area',$data);
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
		$res = MArea::getListPage($where,[],$page,$limit);
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
        foreach ($data as $k=>$item) {
            $item['update_time'] = !empty($item['update_time'])?date('Y-m-d H:i',$item['update_time']):'';
            $data[$k] = $item;
        }
		return $data;
	}
	
	public function getWhere()
	{
		$where = [];
		$area_name       = input('get.area_name','','trim');
		$type    = input('get.type','1','trim');
		if(!empty($area_name)) $where['area_name'] = ['like','%'.$area_name.'%'];
		$where['type'] = $type;
		return $where;
	}
	
	//新增
	public function addArea()
	{
		$data['type'] = input('type')?:1;
		return view('area_add',$data);
	}
	//提交添加
	public function submitdata()
	{
		$data = input();
        $check[] = ['action'=>'string','value'=>$data['area_name']];
        $check[] = ['action'=>'string','value'=>$data['area_code']];
        check($check);
		//验证提交的数据
        $add['area_name'] = $data['area_name'];
        $add['area_code'] = $data['area_code'];
		$add['type'] = $data['type'];
        $add['update_time'] = time();
		$add['site'] = $this->getsessionbanben();//增加版本
		$res = MArea::toAdd($add);
		ajax_cms($res);
	}
	//编辑
	public function edit()
	{
		$id = input('id');
		if(empty($id)){ ajax_cms([],'参数错误');exit;}
		$where['id'] = $id;
		$data['info'] = MArea::getDetail($where);
		return view('area_edit',$data);
	}
	//提交编辑
	public function submitedit()
	{
		$where = [];
		$data = input();
        $check[] = ['action'=>'string','value'=>$data['id']];
        $check[] = ['action'=>'string','value'=>$data['area_name']];
        check($check);
        //验证提交的数据
        $where['id'] = $data['id'];
        $up['area_name']   = $data['area_name'];
        $up['area_code']   = $data['area_code'];
        $up['update_time']    = time();
		$res = MArea::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	
	//删除
	public function deleteArea()
	{
		$id = input('id');
		if(empty($id)) { ajax_cms(false);exit;}
		$where['id'] = $id;
		$up['status'] = '-1';
		$res = MArea::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	
	
	
	//======================产品管理======================
	public function product()
	{
		$data['type'] = input('type')?:1;
		//获取地区
		$where['type'] = $data['type'];
		$where['status'] = 1;
		$where['site'] = $this->getsessionbanben();//增加版本
		$data['area_info'] = MArea::getSelect($where);
		return view('product',$data);
	}
	public function getJsonDataProduct()
	{
		$return = ['msg'=>'success','code'=>0,'data'=>[],'count'=>0];
		$page = $_GET['page'];
		$limit = $_GET['limit'];
		$where = $this->getWhereProduct();
		$where['status'] = 1;
		$where['site'] = $this->getsessionbanben();//增加版本
		//获取列表数据
		$res = MProduct::getListPage($where,[],$page,$limit);
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
		$where['status'] = 1;
		$area_info = MArea::getSelect($where);
		$area = array_column($area_info,'area_name','id');
        foreach ($data as $k=>$item) {
            $item['addtime'] = !empty($item['addtime'])?date('Y-m-d',$item['addtime']):'';
            $item['p_area_name'] = !empty($area[$item['p_area']])?$area[$item['p_area']]:'';
            $data[$k] = $item;
        }
		return $data;
	}
	public function getWhereProduct()
	{
		$where = [];
		$p_name       = input('get.p_name','','trim');
		$p_area       = input('get.p_area','','trim');
		$type    = input('get.type','1','trim');
		if(!empty($p_area)) $where['p_area'] = $p_area;
		if(!empty($p_name)) $where['p_name'] = ['like','%'.$p_name.'%'];
		$where['type'] = $type;
		return $where;
	}
	//添加产品
	public function addProduct()
	{
		$data['type'] = input('type')?:1;
		//获取地区
		$where['type'] = $data['type'];
		$where['status'] = 1;
		$where['site'] = $this->getsessionbanben();//增加版本
		$data['area_info'] = MArea::getSelect($where);
		return view('product_add',$data);
	}
	//tijiao
	public function submitdataP()
	{
		$data = input();
        $check[] = ['action'=>'string','value'=>$data['p_name']];
        $check[] = ['action'=>'string','value'=>$data['p_area']];
        check($check);
		//验证提交的数据
        $add['p_name'] = $data['p_name'];
        $add['p_area'] = $data['p_area'];
        $add['p_nc'] = $data['p_nc'];
        $add['p_yp'] = $data['p_yp'];
        $add['p_kd'] = $data['p_kd'];
        $add['p_ll'] = $data['p_ll'];
		$add['p_ip'] = $data['p_ip'];
		$add['p_money'] = $data['p_money'];
		$add['p_url'] = $data['p_url'];
		$add['sort'] = $data['sort'];
		$add['type'] = $data['type'];
		$add['ddos'] = $data['ddos'];
        $add['addtime'] = time();
		$add['site'] = $this->getsessionbanben();//增加版本
		$res = MProduct::toAdd($add);
		ajax_cms($res);
	}
	//删除
	public function deleteProduct()
	{
		$id = input('id');
		if(empty($id)) { ajax_cms(false);exit;}
		$where['id'] = $id;
		$up['status'] = '-1';
		$res = MProduct::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	//编辑
	public function editP()
	{
		$id = input('id');
		if(empty($id)){ ajax_cms([],'参数错误');exit;}
		$where['id'] = $id;
		$data['info'] = MProduct::getDetail($where);
		//获取地区
		$where1['type'] = $data['info']['type'];
		$where1['status'] = 1;
		$where1['site'] = $this->getsessionbanben();//增加版本
		$data['area_info'] = MArea::getSelect($where1);
		return view('product_edit',$data);
	}
	public function submiteditP()
	{
		$where = [];
		$data = input();
        $check[] = ['action'=>'string','value'=>$data['id']];
        $check[] = ['action'=>'string','value'=>$data['p_name']];
        check($check);
        //验证提交的数据
        $where['id'] = $data['id'];
        $up['p_name'] = $data['p_name'];
        $up['p_area'] = $data['p_area'];
        $up['p_nc'] = $data['p_nc'];
        $up['p_yp'] = $data['p_yp'];
        $up['p_kd'] = $data['p_kd'];
        $up['p_ll'] = $data['p_ll'];
		$up['p_ip'] = $data['p_ip'];
		$up['p_money'] = $data['p_money'];
		$up['p_url'] = $data['p_url'];
		$up['sort'] = $data['sort'];
		$up['ddos'] = $data['ddos'];
        $up['addtime'] = time();
		$res = MProduct::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	
	
	
	
	
	
	
}