<?php 
namespace app\model;
use think\Model;
use think\Db;
class MCompany extends model{
    public static $db_config = 'db_chenchen';
	public static $t_name = 'community_company';

    //获取公司列表
    static function getCompanyPage($condition = array(), $fields = '*', $pagesize = 1, $limit = 10 ,$order = '')
    {
        $res = Db::connect(self::$db_config)->name(self::$t_name)->where($condition)->paginate($limit,false,['page'=>$pagesize]);
        return $res;
    }
    //详情
    static function getCompanyDetail($condition = array(), $field = '*')
    {
        return Db::connect(self::$db_config)->name(self::$t_name)->where($condition)->field($field)->find();
    }
    //编辑
    static function editCompany($condition = array(), $data = [])
    {
        return Db::connect(self::$db_config)->name(self::$t_name)->where($condition)->update($data);
    }

    //新增
    static function addCompany($data = [])
    {
        return Db::connect(self::$db_config)->name(self::$t_name)->insert($data);
    }
	
	//list
	static function getCompanySelect($map)
	{
		return DB::connect(self::$db_config)->name(self::$t_name)->where($map)->select();
	}
	
}