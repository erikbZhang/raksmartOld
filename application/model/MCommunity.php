<?php 
namespace app\model;
use think\Model;
use think\Db;
class MCommunity extends Model{
    public static $db_config = 'db_chenchen';
	
	//获取小区
	static function getCommunityPage($condition = array(), $fields = '*', $pagesize = 1, $limit = 10 ,$order = '')
	{
		$res = Db::connect(self::$db_config)->table('view_community_record')->where($condition)->paginate($limit,false,['page'=>$pagesize]);
		return $res;
	}
	//获取小区信息
	static function getCommunityInfo($map)
	{
		return Db::connect(self::$db_config)->table('view_community_record')->where($map)->find();
	}

	//获取车位信息
	static function getPartNum($map,$group,$field='*')
	{
		$res = Db::connect(self::$db_config)->name('park_num')->where($map)->group($group)->field($field)->select();
		return $res; 
	}
	//统计车位数
	static function getParkNumCount($map)
	{
		$res = Db::connect(self::$db_config)->name('park_num')->where($map)->count();
		return $res; 
	}
	
	//统计房产数
	static function getCommunityEstate($map)
	{
		$res = Db::connect(self::$db_config)->name('p_estate')->where($map)->count();
		return $res; 
	}
	
	//获取物业信息
	static function getPropertyInfo($map)
	{
		$res = Db::connect(self::$db_config)->name('property')->where($map)->find();
		return $res; 
	}
	
	//获取物业
	static function getPropertyValue($map,$value)
	{
		$res = Db::connect(self::$db_config)->name('property')->where($map)->value($value);
		return $res; 
	}
	//======================物业小区档案表======================
	//查询资料
	static function getRecordCount($map)
	{
		$res = Db::connect(self::$db_config)->name('community_record')->where($map)->count();
		return $res; 
	}
	
	//update
	static function getRecordUpdate($where,$up)
	{
		$res = Db::connect(self::$db_config)->name('community_record')->where($where)->update($up);
		return $res; 
	}
	//add
	static function getRecordAdd($add)
	{
		$res = Db::connect(self::$db_config)->name('community_record')->insert($add);
		return $res; 
	}
	//find
	static function getRecordFind($where)
	{
		$res = Db::connect(self::$db_config)->name('community_record')->where($where)->find();
		return $res; 
	}
	//======================物业小区档案扩展表======================
	//查询资料
	static function getExtendCount($map)
	{
		$res = Db::connect(self::$db_config)->name('community_extend')->where($map)->count();
		return $res; 
	}
	
	//update
	static function getExtendUpdate($where,$up)
	{
		$res = Db::connect(self::$db_config)->name('community_extend')->where($where)->update($up);
		return $res; 
	}
	//add
	static function getExtendAdd($add)
	{
		$res = Db::connect(self::$db_config)->name('community_extend')->insert($add);
		return $res; 
	}
	//find
	static function getExtendFind($where)
	{
		$res = Db::connect(self::$db_config)->name('community_extend')->where($where)->find();
		return $res; 
	}
	
	
	
	
	
}