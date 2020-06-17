<?php 
namespace app\model;
use think\Model;
use think\Db;
class MIndex extends Model{
    public static $db_config = 'db_chenchen';
	static function getUserCount($where)
	{
		$res = Db::connect(self::$db_config)->name('user')->where($where)->count();
		return $res;
	}
	static function getMemberCount($where)
	{
		$res = Db::connect(self::$db_config)->name('member')->where($where)->count();
		return $res;
	}

	static function getUserCarCount($where)
	{
		$res = Db::connect(self::$db_config)->name('car_info')->where($where)->count();
		return $res;
	}

	static function getUserEstateCount($where)
	{
		$res = Db::connect(self::$db_config)->name('p_estate')->where($where)->count();
		return $res;
	}

	static function getCommunityCount($where)
	{
		$res = Db::connect(self::$db_config)->name('community')->where($where)->count();
		return $res;
	}

	static function getPropertyInfo($where)
	{
		$res = Db::connect(self::$db_config)->name('property')->where($where)->select();
		return $res;
	}

	static function getCommunityInfo()
	{
		$res = Db::connect(self::$db_config)->name('community')->select();
		return $res;
	}

	static function getUserAdminInfo($where)
	{
		$res = Db::connect(self::$db_config)->name('user_admin')->where($where)->select();
		return $res;
	}

	static function getpropertyUserCount($where)
	{
		$res = Db::connect(self::$db_config)->name('user_admin')->where($where)->count();
		return $res;
	}

	static function getUserCarNumCount($where)
	{
		$res = Db::connect(self::$db_config)->name('park_num')->where($where)->count();
		return $res;
	}
}