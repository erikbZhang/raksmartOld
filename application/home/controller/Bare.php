<?php
namespace app\home\controller;
use think\Controller;
use app\home\controller\HomeBaseController;
use app\model\MBanner;
use app\model\MArea;
use app\model\MProduct;
use app\model\MArticle;

class Bare extends HomeBaseController
{
	/*
	 * 裸机云
	 * */
    public function index()
    {
		//获取banner
		$this->getBannerDetail(2);
		//获取逻辑云配置地区
		$map['type'] = 1;
		$map['status'] = 1;
		$map['site'] = $this->getsessionbanben();//增加版本
		$area = MArea::getSelect($map);
	   	 $details['a_con'] = "裸机云服务器，美国服务器，香港服务器，日本服务器，raksmart";
        $details['a_introduction'] = "RAKsmart—裸机云产品，独享硬件资源，独享带宽和防御，灵活升级产品配置，最快10分钟开通独立服务器。";
        $this->assign('title','美国服务器_香港服务器_日本服务器_高防服务器-RAKsmart提供专业服务器托管、租用服务。');
        $this->assign('details',$details);
		$area_info = $this->GetAreaProduct($area);//获取不同地区下的产品信息
		$this->assign('area_info',$area_info);
		//为什么选择逻辑云
		$condition['c_id'] = 3;
		$condition['status'] = 1;
		$article = MArticle::getSelect($condition,'a_title,a_introduction,a_img');
		$this->assign('article',$article);
        return $this->fetch('/bare');
    }

	/*
	 * 获取不同地区下的产品信息
	 * */
	public function GetAreaProduct($area)
	{
		if(empty($area)) return [];
		$map['status'] = 1;
		$map['site'] = $this->getsessionbanben();//增加版本
		foreach($area as $key=>$value){
			$map['p_area'] = $value['id'];
			$area[$key]['product'] = MProduct::getSelect($map);
		}
		return $area;
	}



}
