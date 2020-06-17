<?php 
namespace app\model;
use think\Model;
use think\Db;
class MMenu extends Model{
	
	
	//获取用户列表
	static function getMenuPage($condition = array(), $fields = '*', $pagesize = 1, $limit = 10 ,$order = 'listorder asc')
	{
		$res = Db::name('menu')->where($condition)->order($order)->paginate($limit,false,['page'=>$pagesize]);
		return $res;
	}
	//获取
	static function getMenuInfo($map)
	{
		return Db::name('menu')->where($map)->find();
	}
	
	static function menuAdd($add)
	{
		return Db::name('menu')->insert($add);
	}
	
	static function menuCount($map)
	{
		return Db::name('menu')->where($map)->count();
	}
	
	static function menuUpdate($map,$up)
	{
		return Db::name('menu')->where($map)->update($up);
	}

	static function menuSelect($map)
	{
		return Db::name('menu')->where($map)->select();
	}
	
	/**
	 *  获取所有菜单
	 */
    static function getMenuAll($map, $field="*", $order = 'listorder asc')
    {
        return Db::name('menu')->where($map)->field($field)->order($order)->select();
    }

}