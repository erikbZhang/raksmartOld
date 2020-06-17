<?php
namespace app\home\controller;
use app\model\MIndex;
use think\Controller;
use app\home\controller\HomeBaseController;
use app\model\MConfig;
use app\model\MArticle;

class All extends HomeBaseController
{
	/*
	 * 关于我们
	 * */
    public function about()
    {
		//获取banner
		$this->getBannerDetail(18);
		//获取配置信息
		$value = $this->getConfigValue('关于我们-订购链接');
		$this->assign('value',$value);
        	 $details['a_con'] = "raksmart，美国服务器，香港服务器，日本服务器，服务器租用，服务器托管";
        $details['a_introduction'] = "RAKsmart—全球数据中心拥有万兆美服务器，提供DDOS防御、美国服务器托管及全球IP传输方案。";
        $this->assign('title','关于我们_RAKsmart全球数据中心，提供一站式服务。');
        $this->assign('details',$details);
		return $this->fetch('/about');
    }

	/*
	 * contact 联系我们
	 * */
	public function contact()
	{
		//获取banner
		$this->getBannerDetail(19);
		//获取配置文件
		$where['id'] = ['in','2,3,4,5,6,7,8'];
		$info  = MConfig::getSelect($where);
		$data = [];
		if(!empty($info)) $data = array_column($info,null,'id');
		$this->assign('data',$data);
		$details['a_con'] = "raksmart，美国服务器，香港服务器，日本服务器，服务器租用，服务器托管";
        $details['a_introduction'] = "RAKsmart—全球数据中心拥有万兆美服务器，提供DDOS防御、美国服务器托管及全球IP传输方案。";
        $this->assign('title','联系我们_RAKsmart全球数据中心，提供一站式服务。');
        $this->assign('details',$details);
		return $this->fetch('/contact');
	}

	/*
	 * join 加入我们
	 * */
	public function join()
	{
		//获取banner
		$this->getBannerDetail(20);
		//获取职位
		$where['c_id'] = 7;
		$where['status'] = 1;
		$where['site'] = $this->getsessionbanben();//增加版本
		$info = MArticle::getSelect($where,'','20','a_id desc');
		$this->assign('info',$info);
		//加入我们文章
		$map['c_id'] = 9;
		$map['status'] = 1;
		$join = MArticle::getDetail($map);
		$this->assign('join',$join);
		$details['a_con'] = "raksmart，美国服务器，香港服务器，日本服务器，服务器租用，服务器托管";
        $details['a_introduction'] = "RAKsmart—全球数据中心拥有万兆美服务器，提供DDOS防御、美国服务器托管及全球IP传输方案。";
        $this->assign('title','加入我们_RAKsmart全球数据中心，提供一站式服务。');
        $this->assign('details',$details);
		return $this->fetch('/join');
	}

	/*
	 * 服务协议
	 * */
	public function sla()
	{
		//获取banner
		$this->getBannerDetail(23);
		//获取服务协议
		$where['c_id'] = 8;
		$where['status'] = 1;
		$info = MArticle::getSelect($where,'','','a_id desc');
		$this->assign('info',$info);
		$details['a_con'] = "raksmart，美国服务器，香港服务器，日本服务器，服务器租用，服务器托管";
        $details['a_introduction'] = "RAKsmart—全球数据中心拥有万兆美服务器，提供DDOS防御、美国服务器托管及全球IP传输方案。";
        $this->assign('title','服务协议_RAKsmart全球数据中心，提供一站式服务。');
        $this->assign('details',$details);
		return $this->fetch('/sla');
	}

}
