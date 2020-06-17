<?php 
namespace app\model;
use think\Model;
use think\Db;
class MRole extends Model{
//    public static $db_config = 'db_chenchen';
	
	//获取角色
	static function getRolePage($condition = array(), $field = '*', $pagesize = 1, $limit = 10 ,$order = 'id desc')
	{
		return Db::name('role')->where($condition)->field($field)->order($order)->paginate($limit,false,['page'=>$pagesize]);
	}
    //获取所有角色
    static function getRoleAll($map, $field="*", $order='id desc')
    {
        return Db::name('role')->where($map)->field($field)->order($order)->select();
    }
	//获取角色信息
	static function getRoleInfo($map, $field = "*")
	{
		return Db::name('role')->where($map)->field($field)->find();
	}

    //更新角色
    static function updateRole($map, $data)
    {
        return Db::name('role')->where($map)->update($data);
    }

    //新增角色
    static function addRole($data)
    {
        return Db::name('role')->insert($data);
    }

    //新增角色权限
    static function addPriv($data)
    {
        return Db::name('role_privilege')->insertAll($data);
    }

    //编辑角色权限
    static function delPriv($where)
    {
        return Db::name('role_privilege')->where($where)->delete();
    }

    //编辑角色权限
    static function getPrivAll($where = [], $field="*")
    {
        return Db::name('role_privilege')->where($where)->field($field)->select();
    }

    //获取角色权限
    static function getRolePirvAll($map=[], $field="*", $order='listorder asc')
    {
        return Db::table('view_role_privilege')->where($map)->field($field)->order($order)->select();
    }
}