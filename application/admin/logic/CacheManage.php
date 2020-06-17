<?php
namespace app\admin\logic;
use think\Db;
use think\Cache;
use app\model\MRole;
class CacheManage
{
    /**
     * [获取角色列表]
     * @return array()
     */
    public function getRoleList()
    {
        $data = cache('role_list');
        if(empty($data)) $data = $this->updateRoleList();
        return $data;
    }

    /**
     * [获取角色列表]
     * @return array()
     */
    public function updateRoleList()
    {
        $list = MRole::getRoleAll(['status'=>1],'role_id,role_name');
        if(!empty($list)) $list = array_column($list,null,'role_id');
        cache('role_list',$list);
        return $list;
    }

	 /**
     * [更新角色权限缓存]
     * @param  [type] $menu [description]
     * @return [type]       [description]
     */
    public function updateRolePriv($role_id)
    {
        $data = $where = [];
        $where['role_id'] = $role_id;
        $field = 'menu_id,menu_name,menu_url,parent,listorder';
        $menu = MRole::getRolePirvAll($where,$field);//获取角色所有权限
        if(!empty($menu)) $data = $this->getMenuTree($menu);
	    cache('role_priv_'.$role_id,$data);
        unset($menu);
	    return $data;
    }
	
	/**
     * [获取某角色权限]
     * @param  role_id 角色id
     * @return array()
     */
    public function getRolePriv($role_id)
    {
        $data = cache('role_priv_'.$role_id);
        if(empty($data)) $data = $this->updateRolePriv($role_id);
        return $data;
    }

    /**
     * 获取菜单权限树
     */
    public function getMenuTree($data)
    {
        $result = $item = [];
        if(empty($data)) return $result;
        $data = array_column($data,null,'menu_id');
        foreach($data as $k=>$val) {
            if(isset($data[$val['parent']])){
                $data[$val['parent']]['child'][] = &$data[$k];
            }else{
                $result[] = &$data[$k];
            }
        }
        return $result;
    }

}