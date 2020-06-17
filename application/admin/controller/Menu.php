<?php 
namespace app\admin\controller;
use app\common\controller\Base;
use think\Controller;
use app\model\MMenu;

class Menu extends Base{
	
	/**
	 * 列表 
	 */
	public function Index()
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
		$res = MMenu::getMenuPage($where,[],$page,$limit);
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
		if(!empty($_GET['menu_name'])) $where['menu_name'] = ['like','%'.$_GET['menu_name'].'%'];
		return $where;
	}
	
	//处理列表信息
	public function clData($data)
	{
		if(empty($data)) return [];
		foreach($data as $k=>$v){
			$data[$k]['listorder'] = "<input  class='layui-input menu_name' onblur='con(this,".$v['id'].")' style='width:60px;height:26px;' type='text' name='listorder' value=".$v['listorder'].">";
		}
		return get_cat_tree($data);
	}
	
	//添加账号
	public function addmenu()
	{
		//获取
		$where['status'] = 1;
		$res = MMenu::menuSelect($where);
		$data['info'] = get_cat_tree($res);
		return view('add',$data);
	}
	
	
	
	//提交数据
	public function submitdata()
	{
		$data = $_POST;
		$add['parent'] = $data['parent'];
		$add['menu_name'] = $data['menu_name'];
		$add['menu_url'] = $data['menu_url'];
		$add['listorder'] = $data['listorder'];
		$add['status'] = 1;
		if($add['parent'] == 0){
			$add['level'] = 1;
		}else{
			$find = MMenu::getMenuInfo(['id'=>$data['parent']]);
			$add['level'] = $find['level']+1;
		}
		$res = MMenu::menuAdd($add);
		ajax_cms($res);
	}
	
	
	//edit
	public function edit()
	{
		$id = $_GET['id'];
		if(empty($id)) ajax_cms([],'参数错误');
		
		$where['id'] = $id;
		$data['data'] = MMenu::getMenuInfo($where);
		
		//获取fuji
		$map['status'] = 1;
		$res = MMenu::menuSelect($map);
		$data['info'] = get_cat_tree($res);
		return view('edit',$data);
	}
	//submitedit
	public function submitedit()
	{
		$data = $_POST;
		if(empty($data['id'])) ajax_cms([],'参数错误');
		
		$update['parent'] = $data['parent'];
		$update['menu_name'] = $data['menu_name'];
		$update['menu_url'] = $data['menu_url'];
		$update['listorder'] = $data['listorder'];
		if($data['parent'] == 0){
			$update['level'] = 1;
		}else{
			$find = MMenu::getMenuInfo(['id'=>$data['parent']]);
			$update['level'] = $find['level']+1;
		}
		$where['id'] = $data['id'];
		$res = MMenu::menuUpdate($where,$update);
		if($res !== false){
			ajax_cms($res);
		}else{
			ajax_cms([],'保存失败');
		}	
	}
	
	//改变状态
	public function changestatus()
	{
		$up['listorder'] = $_POST['value'];
		$id = $_POST['id'];
		$where['id'] = $id;
		$res = MMenu::menuUpdate($where,$up);
		ajax_cms($res);
	}
	
}