<?php 
namespace app\model;
use think\Model;
use think\Db;
class MNetwork extends Model{
	
	
	//获取列表
	static function getListPage($condition = array(), $fields = '*', $pagesize = 1, $limit = 10 ,$order = 'id desc')
	{
		$res = Db::name('network')->where($condition)->order($order)->paginate($limit,false,['page'=>$pagesize]);
		return $res;
	}
	//获取
	static function getInfo($map,$field="*")
	{
		return Db::name('network')->where($map)->field($field)->find();
	}
	
	static function toAdd($add)
	{
		return Db::name('network')->insert($add);
	}
	
	static function toCount($map)
	{
		return Db::name('network')->where($map)->count();
	}
	
	static function toUpdate($map,$up)
	{
		return Db::name('network')->where($map)->update($up);
	}
	static function getDetail($where)
	{
		return Db::name('network')->where($where)->find();
	}
	static function getSelect($map,$field="*",$limit='5',$order="id desc")
	{
		return Db::name('network')->where($map)->field($field)->limit($limit)->order($order)->select();
	}
	static function toDelete($map)
	{
		return Db::name('network')->where($map)->delete();
	}
	
	
}