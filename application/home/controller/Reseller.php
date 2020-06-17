<?php
namespace app\home\controller;
use think\Controller;
use app\home\controller\HomeBaseController;
use app\model\MArticle;
use app\model\MReseller;

class Reseller extends HomeBaseController
{
	/*
	 * Reseller
	 * */
    public function index()
    {
		//获取banner
		$this->getBannerDetail(13);
		//与我们合作！
		$condition['c_id'] = 6;
		$condition['status'] = 1;
		$condition['site'] = $this->getsessionbanben();//增加版本
		$article = MArticle::getDetail($condition,'a_title,a_introduction,a_img');
		$this->assign('article',$article);
		//代理商折扣制度
		$map['site'] = $this->getsessionbanben();//增加版本
		$reseller = MReseller::getSelect($map,'*',6);
		$this->assign('reseller',$reseller);
        	$details['a_con'] = "代理商，代理商折扣，代理商招募，raksmart";
        $details['a_introduction'] = "RAKsmart—全球数据中心拥有万兆美服务器，提供DDOS防御、美国服务器托管及全球IP传输方案。";
        $this->assign('title','美国服务器租用_服务器托管_香港服务器_日本服务器-RAKsmart全球数据中心，招募代理商。');
        $this->assign('details',$details);
		return $this->fetch('/reseller');
    }

	/*
	 * affiliates
	 * */
	public function affiliates()
	{
		//获取banner
		$this->getBannerDetail(17);
		$details['a_con'] = "Affiliates，佣金计划，佣金规则，服务器推荐";
        $details['a_introduction'] = "RAKsmart—全球数据中心拥有万兆美服务器，提供DDOS防御、美国服务器托管及全球IP传输方案。";
        $this->assign('title','Affiliates_RAKsmart全球数据中心，提供一站式服务。');
        $this->assign('details',$details);
		return $this->fetch('/affiliates');
	}









}
