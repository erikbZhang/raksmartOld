<?php 
namespace app\model;
use think\Model;
use think\Db;
class MBanner extends Model{
	
	
	//获取列表
	static function getBannerPage($condition = array(), $fields = '*', $pagesize = 1, $limit = 10 ,$order = 'order_list asc')
	{
		$res = Db::name('banner')->where($condition)->order($order)->paginate($limit,false,['page'=>$pagesize]);
		return $res;
	}
	//获取
	static function getBannerInfo($map,$field="*")
	{
		return Db::name('banner')->where($map)->field($field)->find();
	}
	
	static function bannerAdd($add)
	{
		return Db::name('banner')->insert($add);
	}
	
	static function bannerCount($map)
	{
		return Db::name('banner')->where($map)->count();
	}
	
	static function bannerUpdate($map,$up)
	{
		return Db::name('banner')->where($map)->update($up);
	}
	static function getBannerDetail($where)
	{
		return Db::name('banner')->where($where)->find();
	}
	static function getBannerSelect($where,$field="*",$order="order_list asc")
	{
		return Db::name('banner')->where($where)->field($field)->order($order)->select();
	}
	
	
}
