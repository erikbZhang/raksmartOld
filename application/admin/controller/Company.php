<?php 
namespace app\admin\controller;
use think\Controller;
use think\Cache;
use app\model\MCompany;

class Company extends Controller{

    public function __construct(){
        $user = session('user_info');
        if(!empty($user)) return redirect(url('admin/index/index'));
    }

	/**
	 * 用户列表 
	 */
	public function index()
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
		$where['status'] = ['gt','-1'];
		//获取小区列表数据
		$res = MCompany::getCompanyPage($where,[],$page,$limit);
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
		$name       = input('get.name','','trim');
		$linkman    = input('get.linkman','','trim');
		$mobile     = input('get.mobile','','trim');
		if(!empty($name)) $where['company_name'] = ['like','%'.$name.'%'];
		if(!empty($linkman)) $where['linkman'] = ['like','%'.$linkman.'%'];
		if(!empty($mobile)) $where['mobile'] = ['like','%'.$mobile.'%'];
		return $where;
	}
	
	//处理列表信息
	public function clData($data)
	{
		if(empty($data)) return [];
        foreach ($data as $k=>$item) {
            $item['create_time'] = !empty($item['create_time'])?date('Y-m-d H:i',$item['create_time']):'';
            $data[$k] = $item;
        }
		return $data;
	}
	
	//添加账号
	public function add()
	{
		return view('company_add');
	}
	
	//提交数据
	public function submitdata()
	{
        $data = [];
        $company_name   = input('post.company_name','','trim');
        $linkman        = input('post.linkman','','trim');
        $mobile         = input('post.mobile','','trim');
        $check[] = ['action'=>'string','value'=>$company_name];
        check($check);
		//验证提交的数据
        $data['company_name']   = $company_name;
        $data['linkman']        = $linkman;
        $data['mobile']         = $mobile;
        $data['create_time']    = $data['update_time'] = time();
		$res = MCompany::addCompany($data);
		ajax_cms($res);
	}
	
	//edit
	public function edit()
	{
	    $id = input('get.id','','intval');
		if(empty($id)) ajax_cms([],'参数错误');
		$where['status']  = 1;
		$where['id'] = $id;
		$info = MCompany::getCompanyDetail($where,'*');
		return view('company_edit',$info);
	}
	//submitedit
	public function submitedit()
	{
        $data = $where = [];
        $id             = input('post.id','','trim');
        $company_name   = input('post.company_name','','trim');
        $linkman        = input('post.linkman','','trim');
        $mobile         = input('post.mobile','','trim');
        $check[] = ['action'=>'string','value'=>$id];
        $check[] = ['action'=>'string','value'=>$company_name];
        check($check);
        //验证提交的数据
        $where['id'] = $id;
        $data['company_name']   = $company_name;
        $data['linkman']        = $linkman;
        $data['mobile']         = $mobile;
        $data['update_time']    = time();
		$res = MCompany::editCompany($where,$data);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
}