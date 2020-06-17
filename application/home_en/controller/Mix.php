<?php
namespace app\home_en\controller;
use think\Controller;
use app\model\MBanner;
use app\home_en\controller\HomeBaseController;
use app\model\MMessage;
use app\model\MArticle;

class Mix extends HomeBaseController
{
	/*
	 * 混合云互联
	 * */
    public function index()
    {
		//获取banner
		$this->getBannerDetail(5);
		$details['a_con'] = "混合云，什么是混合云，混合云解决方案，raksmart";
        $details['a_introduction'] = "RAKsmart—全球数据中心拥有万兆美服务器，提供DDOS防御、美
国服务器托管及全球IP传输方案。";
        $this->assign('title','混合云_什么是混合云-RAKsmart提供数据中心之间云互联服务。');
        $this->assign('details',$details);
		//为什么选择逻辑云
		$condition['c_id'] = 3;
		$condition['status'] = 1;
		$article = MArticle::getSelect($condition,'a_title,a_introduction,a_img');
		$this->assign('article',$article);
        return $this->fetch('/mix');
    }

	/*
	 * 提交留言信息
	 * */
	public function submitdata()
	{
		$data = input();
		//五分钟内同一ip不可以重复提交
		$where['ip'] = GetIP();
		$time = time()-60*5;
		$where['addtime'] = ['gt',$time];
		$count = MMessage::toCount($where);
		if($count > 0){
			//不可以重复提交；
			ajax_cms(false,'不可以重复提交');exit;
		}
		$add['name'] = $data['name'];
		$add['email'] = $data['email'];
		$add['tell'] = $data['tell'];
		$add['type'] = $data['type'];
		$add['content'] = $data['content'];
		$add['addtime'] = time();
		$add['ip'] = GetIP();
		$add['site'] = $this->getsessionbanben();
		$res = MMessage::toAdd($add);
		if($res !== false){
			ajax_cms($res);exit;
		}else{
			ajax_cms(false,'提交失败');exit;
		}
	}







}
