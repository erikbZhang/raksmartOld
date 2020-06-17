<?php
namespace app\home\controller;
use think\Controller;
use app\home\controller\HomeBaseController;
use app\model\MArticle;
use app\model\MArticleCat;

class Article extends HomeBaseController
{
	/*
	 * 新闻列表
	 * */
	public function news()
	{
		$c_id = input('c_id','1','trim');
		$banner_code = 21;
		//Huoqu fenlei
		$where['status'] =1;
		$where['pid'] = 1;
		$where['site'] = $this->getsessionbanben();//增加版本
		$info = MArticleCat::getSelect($where);
		//var_dump($info);die;
		//获取banner
		$this->getBannerDetail($banner_code);
		$details['a_con'] = "raksmart，美国服务器，香港服务器，日本服务器，服务器租用，服务器托管";
        $details['a_introduction'] = "RAKsmart—全球数据中心拥有万兆美服务器，提供DDOS防御、美国服务器托管及全球IP传输方案。";
        $this->assign('title','新闻动态_RAKsmart全球数据中心，提供一站式服务。');
        $this->assign('details',$details);
		$this->assign('c_id',$c_id);
		$this->assign('info',$info);
		return $this->fetch('/news');
	}

	//获取全部数据
	public function getNews_new()
	{
		$pageIndex = input('pageIndex',1,'intval');
		$pageSize = input('pageSize',10,'intval');
		$a_type = input('a_type','','trim');
		$c_id = input('c_id','1','intval');

		//获取所有子分类
		$con['pid'] = $c_id;
		$con['status'] = 1;
		$con['site'] = $this->getsessionbanben();//增加版本
		$ids_info = MArticleCat::getSelect($con);
		$ids = array_column($ids_info,'c_id');
		$ids[] = $c_id;

		$where['status'] = 1;
		$where['c_id'] = ['in',$ids];
		$res = MArticle::getListPage($where,$fields = '*', $pageIndex, $pageSize, 'a_id Desc');
		if($res) $res = $res->toarray();
		if(!empty($res['data'])){
			$return['count'] = $res['total'];
			$return['data'] = $this->clDataP($res['data']);
		}else{
			$return = ['msg'=>'数据为空','code'=>1,'data'=>[]];
		}
		exit(json_encode($return));
	}

	//知识库
	public function news_zhishi()
	{
		$c_id = input('c_id','2','trim');
		$banner_code = 22;
		//Huoqu fenlei
		$where['status'] =1;
		$where['pid'] = 2;
		$where['site'] = $this->getsessionbanben();//增加版本
		$info = MArticleCat::getSelect($where);
		//获取banner
		$this->getBannerDetail($banner_code);
		$details['a_con'] = "raksmart，美国服务器，香港服务器，日本服务器，服务器租用，服务器托管";
        $details['a_introduction'] = "RAKsmart—全球数据中心拥有万兆美服务器，提供DDOS防御、美国服务器托管及全球IP传输方案。";
        $this->assign('title','知识库_RAKsmart全球数据中心，提供一站式服务。');
        $this->assign('details',$details);
		$this->assign('c_id',$c_id);
		$this->assign('info',$info);
		return $this->fetch('/news_zhishi');
	}




	/*
	 * ajax 获取新闻中心全部数据
	 * */
	public function getNews()
	{
		$pageIndex = input('pageIndex',1,'intval');
		$pageSize = input('pageSize',10,'intval');
		$a_type = input('a_type','','trim');
		$c_id = input('c_id','1','intval');
		if(!empty($a_type)) $where['a_type'] = $a_type;
		$where['status'] = 1;
		$where['c_id'] = $c_id;
		$where['site'] = $this->getsessionbanben();//增加版本
		$res = MArticle::getListPage($where,$fields = '*', $pageIndex, $pageSize);
		if($res) $res = $res->toarray();
		if(!empty($res['data'])){
			$return['count'] = $res['total'];
			$return['data'] = $this->clDataP($res['data']);
		}else{
			$return = ['msg'=>'数据为空','code'=>1,'data'=>[]];
		}
		exit(json_encode($return));
	}
	//处理数据
	public function clDataP($data)
	{
		if(empty($data)) return [];
		foreach ($data as $k=>$item) {
			$item['a_addtime'] = !empty($item['a_addtime'])?date('Y-m-d',$item['a_addtime']):'';
			$data[$k] = $item;
		}
		return $data;
	}
	/*
	 * 详情
	 * */
    public function details()
    {
		$a_id = input('a_id');
		if(empty($a_id)) $this->error('数据错误');
		$where['a_id'] = $a_id;
		$where['status'] = 1;
		$details = MArticle::getDetail($where);
//新闻还是知识库
		//获取文章分类id信息
		$catinfo =  MArticleCat::getDetail(['c_id'=>$details['c_id']]);
		if(isset($catinfo['pid']) && $catinfo['pid'] > 0){
			$type = $catinfo['pid'];
		}else{
			$type = $catinfo['c_id'];
		}
		//获取上一篇文章标题和下一篇
		$pre = $this->getOneArticle($details,$type,1);
		$next =   $this->getOneArticle($details,$type,0);
		$this->assign('details',$details);
		$this->assign('pre',$pre);
		$this->assign('next',$next);
		$this->assign('type',$type);
		$this->assign('bg3','1');//控制导航样式
		$this->assign('title',$details['a_title']);
        return $this->fetch('/details');
}

	/*
	 * 获取上一篇 下一篇 文章
	 * */
	public function getOneArticle($details,$type,$pre=1)
	{
		if(empty($details['a_id'])) return [];
		if($pre == 1){
			$fh = 'lt';//上一篇
			$order = 'a_id desc';
		}else{
			$fh = 'gt';//下一篇
			$order = 'a_id asc';
		}
		//获取所有子分类
		$con['pid'] = $type;
		$con['status'] = 1;
		$con['site'] = $this->getsessionbanben();//增加版本
		$ids_info = MArticleCat::getSelect($con);
		$ids = array_column($ids_info,'c_id');
		$ids[] = $type;

		$map['c_id'] = ['in',$ids];//只有新闻中心和知识库
		$map['a_id'] = [$fh,$details['a_id']];
		$map['status'] = 1;
		$map['site'] = $this->getsessionbanben();//增加版本
		$info = MArticle::getDetail($map,'*',$order);
		return $info;
	}










}
