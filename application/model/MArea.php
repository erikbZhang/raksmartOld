<?php 
namespace app\model;
use think\Model;
use think\Db;
class MArea extends Model{
	
	
	//获取列表
	static function getListPage($condition = array(), $fields = '*', $pagesize = 1, $limit = 10 ,$order = 'area_code asc')
	{
		$res = Db::name('area')->where($condition)->order($order)->paginate($limit,false,['page'=>$pagesize]);
		return $res;
	}
	//获取
	static function getInfo($map,$field="*")
	{
		return Db::name('area')->where($map)->field($field)->find();
	}
	
	static function toAdd($add)
	{
		return Db::name('area')->insert($add);
	}
	
	static function toCount($map)
	{
		return Db::name('area')->where($map)->count();
	}
	
	static function toUpdate($map,$up)
	{
		return Db::name('area')->where($map)->update($up);
	}
	static function getDetail($where)
	{
		return Db::name('area')->where($where)->find();
	}
	static function getSelect($map,$field="*",$order="area_code asc")
	{
		return Db::name('area')->where($map)->field($field)->order($order)->select();
	}
	
	
	
}