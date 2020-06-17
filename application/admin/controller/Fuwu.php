<?php 
namespace app\admin\controller;
use app\common\controller\Base;
use think\Controller;
use think\Cache;
use app\model\MFuwu;
use app\model\MFuwuType;
use app\model\MDictionaries;

class Fuwu extends Base{

    public function __construct(){
        $user = session('user_info');
        if(!empty($user)) return redirect(url('admin/index/index'));
    }
	/**
	 * 列表 
	 */
	public function index()
	{
		//获取产品类型
		$data['dictionaries_info'] = $this->getConfigulationType();
		return view('index',$data);
	}

	/*
	 * 获取产品类型
	 * */
	public function getConfigulationType()
	{
		$where['status'] = 1;
		$where['site'] = $this->getsessionbanben();//增加版本
		$data = MFuwuType::getSelect($where,'*','id desc');
		return $data;
	}

	//获取参数
	public function clDictionariesData()
	{
		$where['status'] = 1;
		$where['site'] = $this->getsessionbanben();//增加版本
		$dictionaries = MDictionaries::getSelect($where);
		$arr = [];
		foreach($dictionaries as $k=>$v){
			$arr[$v['type']][] = $v;
		}
		return $arr;
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
		$res = MFuwu::getListPage($where,[],$page,$limit,'id desc');
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
		$dictionaries_type = $this->getConfigulationType();//lang('dictionaries_type');
		$dictionaries_type = array_column($dictionaries_type,'name','id');
        foreach ($data as $k=>$item) {
            if(!empty($dictionaries_type[$item['type']])){
				$data[$k]['type_name'] = $dictionaries_type[$item['type']];
			}
            $data[$k]['addtime'] = !empty($item['addtime'])?date('Y-m-d H:i',$item['addtime']):'';
        }
		return $data;
	}
	
	public function getWhere()
	{
		$where = [];
		$type   = input('get.type','','trim');
		$name   = input('get.name','','trim');
		if(!empty($type)) $where['type'] = $type;
		if(!empty($name)) $where['name'] = ['like','%'.$name.'%'];
		return $where;
	}
	
	//新增
	public function addNet()
	{
		$data['dictionaries_type'] = $this->getConfigulationType();//lang('dictionaries_type');
		$data['dictionaries_info'] = $this->clDictionariesData();
		return view('add',$data);
	}
	//提交添加
	public function submitdata()
	{
		$data = input();
        //$check[] = ['action'=>'int','value'=>$data['type']];
        //$check[] = ['action'=>'string','value'=>$data['name']];
        //$check[] = ['action'=>'int','value'=>$data['unumber']];
        //check($check);
		//验证提交的数据
        $add['type'] = intval($data['type']);
        $add['name'] = $data['name'];
        $add['unumber'] = intval($data['unumber']);
        $add['dian'] = $data['dian'];
        $add['pdu'] = $data['pdu'];
        $add['kou'] = $data['kou'];
        $add['ip'] = $data['ip'];
        $add['money'] = $data['money'];
        $add['go'] = $data['go'];
		$add['addtime'] = time();
		$add['status'] = 1;
		$add['site'] = $this->getsessionbanben();//增加版本
		$res = MFuwu::toAdd($add);
		ajax_cms($res);
	}
	//编辑
	public function editNet()
	{
		$id = input('id');
		if(empty($id)){ ajax_cms([],'参数错误');exit;}
		$where['id'] = $id;
		$data['info'] = MFuwu::getDetail($where);
		$data['dictionaries_type'] = $this->getConfigulationType();//lang('dictionaries_type');
		$data['dictionaries_info'] = $this->clDictionariesData();
		return view('edit',$data);
	}
	//提交编辑
	public function submitedit()
	{
		$where = [];
		$data = input();
        $check[] = ['action'=>'string','value'=>$data['id']];
        $check[] = ['action'=>'string','value'=>$data['name']];
        $check[] = ['action'=>'string','value'=>$data['type']];
        $check[] = ['action'=>'string','value'=>$data['unumber']];
        check($check);
        //验证提交的数据
        $where['id'] = $data['id'];
		$up['type'] = $data['type'];
		$up['name'] = $data['name'];
		$up['unumber'] = $data['unumber'];
		$up['dian'] = $data['dian'];
		$up['pdu'] = $data['pdu'];
		$up['kou'] = $data['kou'];
		$up['ip'] = $data['ip'];
		$up['money'] = $data['money'];
		$up['go'] = $data['go'];
		$res = MFuwu::toUpdate($where,$up);
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
		$res = MFuwu::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}

	/*
	 * 类型管理
	 * */
	public function type()
	{
		return view('index_type',[]);
	}
	public function getJsonDataType()
	{
		$return = ['msg'=>'success','code'=>0,'data'=>[],'count'=>0];
		$page = $_GET['page'];
		$limit = $_GET['limit'];
		$where = $this->getWhereType();
		$where['status'] = ['gt','-1'];
		$where['site'] = $this->getsessionbanben();//增加版本
		//获取列表数据
		$res = MFuwuType::getListPage($where,[],$page,$limit,'id desc');
		if($res) $res = $res->toarray();
		if(!empty($res['data'])){
			$return['count'] = $res['total'];
			$return['data'] = ($res['data']);
		}else{
			$return = ['msg'=>'数据为空','code'=>1,'data'=>[]];
		}
		exit(json_encode($return));
	}
	public function getWhereType()
	{
		$where = [];
		$name      = input('get.name','','trim');
		if(!empty($name)) $where['name'] = ['like','%'.$name.'%'];
		return $where;
	}
	/*
	 * 添加类型
	 * */
	public function addNetType()
	{
		return view('add_type',[]);
	}
	/*
	 * 保存
	 * */
	public function submitdataType()
	{
		$data = input();
		$check[] = ['action'=>'string','value'=>$data['name']];
		check($check);
		//验证提交的数据
		$add['name'] = $data['name'];
		$add['status'] = 1;
		$add['site'] = $this->getsessionbanben();//增加版本
		$res = MFuwuType::toAdd($add);
		ajax_cms($res);
	}
	/*
	 * 删除
	 * */
	public function deleteNetType()
	{
		$id = input('id');
		if(empty($id)) { ajax_cms(false);exit;}
		$where['id'] = $id;
		$up['status'] = '-1';
		$res = MFuwuType::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
		ajax_cms(false,'保存失败');
	}
	/*
	 * 编辑
	 * */
	public function editNetType()
	{
		$id = input('id');
		if(empty($id)){ ajax_cms([],'参数错误');exit;}
		$where['id'] = $id;
		$data['info'] = MFuwuType::getDetail($where);
		return view('edit_type',$data);
	}
	/*
	 * 提交编辑
	 * */
	public function editdataType()
	{
		$where = [];
		$data = input();
		$check[] = ['action'=>'string','value'=>$data['name']];
		check($check);
		//验证提交的数据
		$where['id'] = $data['id'];
		$up['name'] = $data['name'];
		$res = MFuwuType::toUpdate($where,$up);
		if($res !== false) ajax_cms(true);
		ajax_cms(false,'保存失败');
	}
	
	
	
	
	
	
}
