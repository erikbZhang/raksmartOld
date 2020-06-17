<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace app\home_en\controller;

use think\Db;
use app\model\MBanner;
use app\model\MConfig;
use think\Controller;

class HomeBaseController extends Controller
{

    /*
     * 获取单张轮播图
     *
     * */
    public function getBannerDetail($banner_type,$assign_name=''){
        $where_b['banner_type'] = $banner_type;
        $where_b['status'] = 1;
		$where_b['site'] = $this->getsessionbanben();//增加版本
        $banner_info = MBanner::getBannerDetail($where_b);
        if(empty($assign_name)) $assign_name = 'banner_info';
        $this->assign($assign_name,$banner_info);
    }

    /*
     * 获取多张轮播图
     * */
    public function getBannerSelect($banner_type,$assign_name='')
    {
        $where_b['banner_type'] = $banner_type;
        $where_b['status'] = 1;
		$where_b['site'] = $this->getsessionbanben();//增加版本
        $banner_info = MBanner::getBannerSelect($where_b,'name,banner_id,img_url,img_url2,point_url,order_list','order_list asc');
        if(empty($assign_name)) $assign_name = 'banner_info';
        $this->assign($assign_name,$banner_info);
    }

    /*
     * 获取配置i信息
     * */
    public function getConfigValue($name='')
    {
        if(empty($name)) return '';
        $where['name'] = $name;
		$where['site'] = $this->getsessionbanben();//增加版本
        $info = MConfig::getDetail($where);
        if(!empty($info['value'])) return $info['value'];
        return '';
    }
	
	//获取版本切换
	public function getsessionbanben()
	{
		return 2;//中文版本
	}


}