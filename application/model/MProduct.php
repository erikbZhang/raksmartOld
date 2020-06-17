<?php 
namespace app\model;
use think\Model;
use think\Db;
class MProduct extends Model{
	
	
	//获取列表
	static function getListPage($condition = array(), $fields = '*', $pagesize = 1, $limit = 10 ,$order = 'sort asc')
	{
		$res = Db::name('product')->where($condition)->order($order)->paginate($limit,false,['page'=>$pagesize]);
		return $res;
	}
	//获取
	static function getInfo($map,$field="*")
	{
		return Db::name('product')->where($map)->field($field)->find();
	}
	
	static function toAdd($add)
	{
		return Db::name('product')->insert($add);
	}
	
	static function toCount($map)
	{
		return Db::name('product')->where($map)->count();
	}
	
	static function toUpdate($map,$up)
	{
		return Db::name('product')->where($map)->update($up);
	}
	static function getDetail($where)
	{
		return Db::name('product')->where($where)->find();
	}
	static function getSelect($map,$field="*")
	{
		return Db::name('product')->where($map)->field($field)->select();
	}
	
	
	
}