<?php
namespace app\home\controller;
use think\Controller;
use app\home\controller\HomeBaseController;
use app\model\MArticle;
use app\model\MArticleCat;
use app\model\MConfiguration;
use app\model\MFuwu;
use app\model\MFuwuType;

class Solution extends HomeBaseController
{
	/*
	 * 一站式解决方案
	 * */
    public function index()
    {
		//获取banner
		$this->getBannerDetail(11);
	  	 $details['a_con'] = "全球托管方案，定制化服务，一站式托管服务，DDOS解决方案";
        $details['a_introduction'] = "RAKsmart通过提供专业的业务流程，为您带来省钱、省心、省时、省力的一站式服务，帮助您实现即时部署，无忧购买！";
        $this->assign('title','定制化服务_全球托管方案_24*7技术支持-RAKsmart提供全球托管定制化服务。');
        $this->assign('details',$details);	
		//为什么选择逻辑云
		$condition['c_id'] = 3;
		$condition['status'] = 1;
		$condition['site'] = $this->getsessionbanben();//增加版本
		$article = MArticle::getSelect($condition,'a_title,a_introduction,a_img');
		$this->assign('article',$article);
        return $this->fetch('/solution');
    }

	/*
	 * trusteeship 服务器托管
	 * */
	public function trusteeship()
	{
		//获取banner
		$this->getBannerDetail(15);
		//配置产品
		 $details['a_con'] = "美国服务器托管_香港服务器托管_整机柜托管-Raksmart全球数据中心，提供一站式托管服务。";
        $details['a_introduction'] = "主机托管，服务器托管，美国服务器托管，整机柜托管";
        $this->assign('title','RAKsmart—提供最专业服务器托管服务，数据中心全球覆盖，专业技术团队为您提供7*24小时全方位服务。');
        $this->assign('details',$details);
		$type = $this->getConfigulationType();
		//获取分类下的产品，最多十条数据
		$arr = [];
		if(!empty($type)){
			$where['status'] = 1;
			foreach ($type as $k=>$v) {
				$where['type'] = $v['id'];
				$array = MFuwu::getSelect($where,'*','10');
				$info = isset($array)?$array:'';
				$type = $v;
				$arr[] = ['type'=>$v['id'],'type_name'=>$v['name'],'info'=>$info];
			}
		}
		foreach($arr as &$v){
  		  unset($v['ip']);
		}
                    unset($v);
		$this->assign('data',$arr);
		$this->assign('product_name','配置产品');
		//获取数据中心设施内容
		$map['c_id'] = 5;
		$map['status'] = 1;
		$map['site'] = $this->getsessionbanben();//增加版本
		$artcle_info = $this->getInfoAll();//MArticle::getSelect($map,'a_id,a_title,a_con,a_img,a_content,a_url',6);
		$this->assign('artcle_info',$artcle_info);
		return $this->fetch('/trusteeship');
	}

	/*
         * 获取产品类型
         * */
	public function getConfigulationType()
	{
		$where['status'] = 1;
		$where['site'] = $this->getsessionbanben();//增加版本
		$data = MFuwuType::getSelect($where,'*','id desc');
		return $data;
	}
//获取数据中心设施内容
	public function getInfoAll()
	{
		//获取收据中心下的所有子分类
		$map['pid'] = 5;
		$map['status'] = 1;
		$map['site'] = $this->getsessionbanben();//增加版本
		$cat = MArticleCat::getSelect($map);
		if(!empty($cat)){
			//获取所有分类下的文章
			foreach($cat as $k=>$v){
				$where['c_id'] = $v['c_id'];
				$where['status'] = 1;
				$info = MArticle::getDetail($where);//该分类下的文章
				$cat[$k]['a_id'] = (!empty($info['a_id']))?$info['a_id']:'';
				$cat[$k]['a_title'] = (!empty($info['a_title']))?$info['a_title']:'';
				$cat[$k]['c_id'] = (!empty($info['c_id']))?$info['c_id']:'';
				$cat[$k]['a_con'] = $v['c_name'];
				$cat[$k]['a_content'] = (!empty($info['a_content']))?$info['a_content']:'';
				$cat[$k]['a_img'] = (!empty($info['a_img']))?$info['a_img']:'';
				$cat[$k]['a_url'] = (!empty($info['a_url']))?$info['a_url']:'';
			}
		}
		return $cat;
	}







}
