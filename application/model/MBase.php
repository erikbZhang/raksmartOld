<?php 
namespace app\model;
use think\Model;
use think\Db;
class MBase extends Model{
	
	static $table_name;
	//获取列表
	static function getListPage($condition = array(), $fields = '*', $pagesize = 1, $limit = 10 ,$order = '')
	{
		$res = Db::name(static::$table_name)->where($condition)->order($order)->paginate($limit,false,['page'=>$pagesize]);
		return $res;
	}
	//获取
	static function getInfo($map,$field="*")
	{
		return Db::name(static::$table_name)->where($map)->field($field)->find();
	}
	
	static function toAdd($add)
	{
		return Db::name(static::$table_name)->insert($add);
	}
	
	static function toCount($map)
	{
		return Db::name(static::$table_name)->where($map)->count();
	}
	
	static function toUpdate($map,$up)
	{
		return Db::name(static::$table_name)->where($map)->update($up);
	}
	static function getDetail($where,$field='*',$order='')
	{
		return Db::name(static::$table_name)->where($where)->field($field)->order($order)->find();
	}
	static function getSelect($map,$field="*",$limit="",$order='')
	{
		return Db::name(static::$table_name)->where($map)->limit($limit)->order($order)->field($field)->select();
	}
	static function toDelete($map)
	{
		return Db::name(static::$table_name)->where($map)->delete();
	}
	
	
}