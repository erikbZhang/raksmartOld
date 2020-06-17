<?php
namespace app\home\controller;
use app\model\MIndex;
use think\Controller;
use app\home\controller\HomeBaseController;
use app\model\MBanner;
use app\model\MArea;
use app\model\MProduct;
use app\model\MArticle;

class Large extends HomeBaseController
{

	/*
	 * 大宽带服务器
	 * */
    public function index()
    {
		//获取banner
		$this->getBannerDetail(3);
		//获取逻辑云配置地区
		$map['type'] = 2;
		$map['status'] = 1;
		$map['site'] = $this->getsessionbanben();//增加版本
		$area = MArea::getSelect($map);
		$area_info = $this->GetAreaProduct($area);//获取不同地区下的产品信息
		 $details['a_con'] = "大带宽服务器，大流量服务器，千兆服务器，万兆服务器";
        $details['a_introduction'] = "RAKsmart—全球数据中心拥有万兆美服务器，提供DDOS防御、美国服务器托管及全球IP传输方案。";
        $this->assign('title','百兆独享_千兆服务器_万兆服务器-RAKsmart机房10年专注大带宽服务器租用。');
        $this->assign('details',$details);
		$this->assign('area_info',$area_info);//print_r($area_info);
		//大带宽服务器的优势
		$condition['c_id'] = 4;
		$condition['status'] = 1;
		$condition['site'] = $this->getsessionbanben();//增加版本
		$article = MArticle::getSelect($condition,'a_title,a_introduction,a_img');
		$this->assign('article',$article);
        return $this->fetch('/large');
    }

	/*
	 * 获取不同地区下的产品信息
	 * */
	public function GetAreaProduct($area)
	{
		if(empty($area)) return [];
		$map['status'] = 1;
		foreach($area as $key=>$value){
			$map['p_area'] = $value['id'];
			$area[$key]['product'] = MProduct::getSelect($map);
		}
		return $area;
	}



}
