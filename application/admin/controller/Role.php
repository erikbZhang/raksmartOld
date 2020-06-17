<?php 
namespace app\admin\controller;
use app\common\controller\Base;
use app\model\MRole;
use app\model\MMenu;
class Role extends Base{
	public function index()
	{
		return view();
	}

    //角色编辑
    public function edit()
    {
        $role_id = input('get.role_id','','trim');
        $where = [];
        $where['role_id'] = $role_id;
        $res = MRole::getRoleInfo($where,'*');
        return view('',$res);
    }

    //角色编辑
    public function saveEditData()
    {
        $role_id     = input('post.role_id','','trim');
        $role_name   = input('post.role_name','','trim');
        $remark      = input('post.remark','','trim');
        $check[] = ['action'=>'string','value'=>$role_name];
        $check[] = ['action'=>'string','value'=>$role_id];
        check($check);
        $where = $update = [];
        $where['role_id']       = $role_id;
        $update['role_name']    = $role_name;
        $update['remark']       = $remark;
        $res = MRole::updateRole($where,$update);
        model('cacheManage','logic')->updateRoleList();//更新角色列表
        ajax_cms($res);
    }
    //新增角色
    public function add()
    {
        return view();
    }

    //新增角色
    public function addData()
    {
        $role_id     = input('post.role_id','','trim');
        $role_name   = input('post.role_name','','trim');
        $remark      = input('post.remark','','trim');
        $check[] = ['action'=>'string','value'=>$role_name];
        check($check);
        $data = [];
        $data['role_id']      = create_id();
        $data['role_name']    = $role_name;
        $data['remark']       = $remark;
        $res = MRole::addRole($data);
        model('cacheManage','logic')->updateRoleList();//更新角色列表
        ajax_cms($res);
    }

    /**
     * 角色绑定权限
     */
    public function bindPriv()
    {
        $where = $data = $map = [];
        $role_id = input('param.role_id','','trim');
        if(request()->isAjax()){
            $check[] = ['action'=>'string','value'=>$role_id];
            check($check);
            $menu_ids = input('post.menu_ids','','trim');
            $data = $this->handleMenuId($role_id,$menu_ids);
            $where['role_id'] = $role_id;
            $res = MRole::delPriv($where);
            if($res === false) ajax_cms(false);
            if(!empty($data)) $res = MRole::addPriv($data);
            $this->publicCache($role_id); //更新缓存
            ajax_cms($res);
        }
        $where['status']  = 1;
        $data['menu'] = MMenu::getMenuAll($where); //获取所有的菜单
        $map['role_id'] = $role_id;
        $data['user_menu'] = MRole::getPrivAll($map,'menu_id');  //获取用户权限菜单
        !empty($data['user_menu'])?$data['user_menu'] = array_column($data['user_menu'],'menu_id'):"";
        $data['menu'] = model('menu','logic')->getMenuTree($data['menu'],$data['user_menu']);
        $data['menu']    = json_encode($data['menu'],JSON_UNESCAPED_UNICODE);
        $data['user_menu'] = implode(',',$data['user_menu']);
        $data['role_id'] = $role_id;
        return view('',$data);
    }

    /**
     * 批量删除
     */
    public function batchDel()
    {
        $ids     = input('post.ids','','trim');
        $check[] = ['action'=>'string','value'=>$ids];
        check($check);
        $data = $where = [];
        $where['role_id'] = ['in',$ids];
        $data['status']      = -1;
        $res = MRole::updateRole($where, $data);
        model('cacheManage','logic')->updateRoleList();//更新角色列表
        $res = $res !== false ? true : false;
        ajax_cms($res);
    }
    //获取角色列表
    public function getJsonData()
    {
        $return = ['msg'=>'success','code'=>0,'data'=>[],'count'=>0];
        $page = input('get.page','1','intval');
        $limit = input('get.limit','10','intval');
        $where = $this->getWhere();
        //获取角色列表
        $res = MRole::getRolePage($where,'*',$page,$limit);
        if($res) $res = $res->toarray();
        ajax_cms($res['data'],'',$res['total']);

    }

    /**
     *  处理筛选信息
     */
    public function getWhere()
    {
        $where = ['status'=>1];
        $role_name = input('get.role_name','','trim');
        if(!empty($role_name)) $where['role_name'] = ['like',$role_name.'%'];
        return $where;
    }

    /**
     * 角色绑定权限
     * @param $role_id 角色id
     * @param menu_id 权限菜单id 字符串
     * @return array()
     */
    public function handleMenuId($role_id,$menu_ids)
    {
        $data = [];
        if(empty($menu_ids)) return $data;
        is_string($menu_ids)?$menu_ids = explode(',',$menu_ids):'';
        foreach ($menu_ids as $r) {
            $data[] = ['role_id'=>$role_id, 'menu_id'=>$r];
        }
        return $data;
    }

    public function publicCache($role_id)
    {
        model('cacheManage','logic')->updateRolePriv($role_id);
    }

}