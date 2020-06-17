<?php 
namespace app\model;
use think\Model;
use think\Db;
class MUser extends Model{
	
	
	//获取用户列表
	static function getUserPage($condition = array(), $fields = '*', $pagesize = 1, $limit = 10 ,$order = '')
	{
		$res = Db::name('user')->where($condition)->paginate($limit,false,['page'=>$pagesize]);
		return $res;
	}
	//获取
	static function getUserInfo($map,$field="*")
	{
		return Db::name('user')->where($map)->field($field)->find();
	}
	
	static function userAdd($add)
	{
		return Db::name('user')->insert($add);
	}
	
	static function userCount($map)
	{
		return Db::name('user')->where($map)->count();
	}
	
	static function userUpdate($map,$up)
	{
		return Db::name('user')->where($map)->update($up);
	}
	
	
	
	
}