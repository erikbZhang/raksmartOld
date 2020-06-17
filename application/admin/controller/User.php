<?php 
namespace app\admin\controller;
use think\Controller;
use think\Cache;
use app\model\MUser;
use app\model\MRole;//角色

class User extends Controller{

    public function __construct(){
        $user = session('user_info');
        if(!empty($user)) return redirect(url('admin/index/index'));
    }

    /**
     * 登录
     */
    public function login()
    {
        if(!request()->isAjax())  return view();
		
        $password = input('post.password','','trim');
        $username = input('post.username','','trim');
        $code 	  = input('post.vercode','','trim');
        $check[] = ['action'=>'string','value'=>$username];
        $check[] = ['action'=>'string','value'=>$password];
        //$check[] = ['action'=>'string','value'=>$code];
        check($check);
//        if(!captcha_check($code)) ajax_cms(false,'验证码错误');
        $where['account'] = $username;
        $where['status']  = 1;
        $user = MUser::getUserInfo($where,'id,user_id,account,password,user_name,role_id');
        if(empty($user) || $user['password'] != password($password)) ajax_cms(false,'账号或密码错误');
        unset($user['password']);
        $priv = model('cacheManage','logic')->getRolePriv($user['role_id']);//获取角色权限
        session('user_info',$user);
        session('menu_list',$priv);
        ajax_cms(true);
    }

	/**
	 * 用户列表 
	 */
	public function index()
	{
		return view('user_index');
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
		$res = MUser::getUserPage($where,[],$page,$limit);
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
		if(!empty($_GET['account'])) $where['account'] = ['like','%'.$_GET['account'].'%'];
		if(!empty($_GET['user_name'])) $where['user_name'] = ['like','%'.$_GET['user_name'].'%'];
		if(!empty($_GET['phone'])) $where['phone'] = $_GET['phone'];
		return $where;
	}
	
	//处理列表信息
	public function clData($data)
	{
		if(empty($data)) return [];
        //$role = model('cacheManage','logic')->getRoleList();//获取角色列表
		foreach($data as $k=>$v){
			if($v['status'] == 0)
                $v['status_name'] = '<button onclick="qjyong('.$v['status'].',`'.$v['user_id'].'`)"  class="layui-btn layui-btn-xs" title="点击启用">启用</button>';
			else $v['status_name'] = '<button onclick="qjyong('.$v['status'].',`'.$v['user_id'].'`)" class="layui-btn layui-btn-primary layui-btn-xs" title="点击禁用">禁用</button>';
			if($v['id'] == 1) $v['status_name'] = '';
			//$v['role_name'] = isset($role[$v['role_id']])?$role[$v['role_id']]['role_name']:'';
			$data[$k] = $v;
		}
		return $data;
	}
	
	//添加账号
	public function adduser()
	{
		return view('user_add');
	}
	
	//提交数据
	public function submitdata()
	{
		$data = $_POST;
		//验证提交的数据
		$this->yzSubmintData($data);
		$add['user_id'] = create_id();
		$add['account'] = $data['account'];
		$add['password'] = password($data['password']);
		$add['user_name'] = $data['user_name'];
		$add['phone'] = $data['phone'];
		$add['status'] = 1;
		$res = MUser::userAdd($add);
		ajax_cms($res);
	}
	
	//验证提交的数据
	public function yzSubmintData($data)
	{
		if(empty($data['password']) || empty($data['passwordtwo']))  ajax_cms([],'两次密码不一致');
		//账号不可以重复
		$map['account'] = $data['account'];
		$map['status'] = ['neq','-1'];
		$count = MUser::userCount($map);
		if($count > 0){
			ajax_cms(false,'该账号已经存在,请选择其他的账号名称');
		}
	}
	
	//edit
	public function edit()
	{
		$user_id = $_GET['user_id'];
		if(empty($user_id)) ajax_cms([],'参数错误');
		
		$where['user_id'] = $user_id;
		$info = MUser::getUserInfo($where);
		//获取角色
		//$map['status'] = 1;
		//$info['role'] = MRole::getRoleAll($map);
		return view('user_edit',$info);
	}
	//submitedit
	public function submitedit()
	{
		$data = $_POST;
		if(empty($data['user_id'])) ajax_cms([],'参数错误');
		
		if(!empty($data['password'])) $up['password'] = password($data['password']);
		$up['user_name'] = $data['user_name'];
		$up['phone'] = $data['phone'];
		//$up['role_id'] = $data['role_id'];
		$where['user_id'] = $data['user_id'];
		$res = MUser::userUpdate($where,$up);
		if($res !== false){
			ajax_cms($res);
		}else{
			ajax_cms(false,'保存失败');
		}	
	}
	
	//改变状态
	public function changestatus()
	{
		$up['status'] = 0;
		$status = $_POST['status'];
		$user_id = $_POST['user_id'];
		if($status == 0) $up['status'] = 1;
		$where['user_id'] = $user_id;
		$res = MUser::userUpdate($where,$up);
		ajax_cms($res);
	}
	
	
	//修改用户密码
	public function changepassword()
	{
		$user_id = session('user_info.user_id');
		$where['user_id'] = $user_id;
		$info = MUser::getUserInfo($where);
		return view('changepassword',$info);
	}
	
	//提交修改密码
	public function submitpassword()
	{
		$data = $_POST;
        $data['user_id'] = session('user_info.user_id');
		if(empty($data['old_password']) ||empty($data['user_id']) || empty($data['new_password'])){
			ajax_cms([],'数据错误，请重试');
		}
		if(strlen($data['new_password']) < 6) ajax_cms([],'新密码长度不能少于六位');
		
		if($data['new_password'] != $data['new_password_two']) ajax_cms([],'两次密码输入不一致');
		//验证密码
		$count = MUser::userCount(['user_id'=>$data['user_id'],'password'=>password($data['old_password'])]);
		if($count == 0){
			ajax_cms(false,'原密码输入错误');
		}
		$where['user_id'] = $data['user_id'];
		$up['password'] = password($data['new_password']);
		$up['user_name'] = $data['user_name'];
		$up['phone'] = $data['phone'];
		$res = MUser::userUpdate($where,$up);
		ajax_cms($res);
	}

    //注销
	public function logout()
    {
        session('user_info',null); //用户信息
        session('menu_list',null); //角色权限
		session('banben_english',null);
        return redirect(url('admin/user/login'));
    }

    //清空缓存
    public function clearCache()
    {
        Cache::clear();
        ajax_cms(true,'操作成功');
    }
	
	/* 
	 * 切换中英文
	 */
	public function china()
	{
		$english = input('english')?:'1';//默认1 中文版
		session('banben_english',$english);
		return redirect(url('admin/index/index'));
	}
	
	
}