<?php
namespace app\home\controller;
use think\Controller;
use app\home\controller\HomeBaseController;
use app\model\MDictionaries;
use app\model\MDing;

class Custom extends HomeBaseController
{
    public function index()
    {
		//获取banner
		$this->getBannerDetail(4);
		//获取所有类别数据
		$where['status'] = 1;
		$where['site'] = $this->getsessionbanben();//增加版本
	  	 $details['a_con'] = "服务器定制，服务器配置，DIY服务器，服务器租用定制
";
        $details['a_introduction'] = "RAKsmart—全球数据中心拥有万兆美服务器，提供DDOS防御、美国服务器托管及全球IP传输方案。";
        $this->assign('title','服务器定制_服务器租用定制_DIY服务器-RAKsmart专业服务器定制化提供者。');
        $this->assign('details',$details);
		$dictionaries = MDictionaries::getSelect($where);
		$dictionaries_info = $this->clData($dictionaries);
		$this->assign('dictionaries_info',$dictionaries_info);
        return $this->fetch('/custom');
    }

	/*
	 * 处理数据，根据不同type进行数据分类
	 * */
	public function clData($data)
	{
		if(empty($data)) return [];
		$arr = [];
		foreach($data as $k=>$v){
			$arr[$v['type']][] = $v;
		}
		return $arr;
	}

	/*
	 * 提交数据表单
	 *
	 * */
	public function submitdata()
	{
		$data = input();
		//五分钟内同一ip不可以重复提交
		$where['ip'] = GetIP();
		$where['status'] = 1;
		$time = time()-60*5;
		$where['addtime'] = ['gt',$time];
		$count = MDing::toCount($where);
		if($count > 0){
			//不可以重复提交；
			ajax_cms(false,'不可以重复提交');exit;
		}
		$add['d_country'] = $data['d_country'];
		$add['d_cpu'] = $data['d_cpu'];
		$add['d_nc'] = $data['d_nc'];
		$add['d_yp'] = $data['d_yp'];
		$add['d_ip'] = $data['d_ip'];
		$add['d_wl'] = $data['d_wl'];
		$add['d_kd'] = $data['d_kd'];
		$add['d_other'] = $data['d_other'];
		$add['d_tell'] = $data['d_tell'];
		$add['d_email'] = $data['d_email'];
		$add['d_qq'] = $data['d_qq'];
		$add['d_name'] = $data['d_name'];
		$add['d_skype'] = $data['d_skype'];
		$add['addtime'] = time();
		$add['ip'] = GetIP();
		$add['site'] = 1;
		$res = MDing::toAdd($add);
		if($res !== false){
			ajax_cms($res);exit;
		}else{
			ajax_cms(false,'提交失败');exit;
		}
	}






}
