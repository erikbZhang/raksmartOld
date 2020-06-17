<?php 
namespace app\model;
use think\Model;
use think\Db;
use app\model\MBase;
class MArticleCat extends MBase{
	public static $table_name = 'article_class';

	/**
	 * 获取文章分类
	 * @return array
	 */
	static function getArticleCatList()
	{
		$where = [];
		$where['status'] = ['gt','-1'];
		$list = MArticleCat::getSelect($where,'c_name,c_id','','listorder asc,c_id desc');
		return $list;
	}
}
