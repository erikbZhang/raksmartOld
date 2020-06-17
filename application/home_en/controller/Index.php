<?php
namespace app\home_en\controller;
use app\home_en\controller\HomeBaseController;
use app\model\MIndex;
use think\Controller;
use app\model\MBanner;
use app\model\MArticle;
use app\model\MArticleCat;
use app\model\MPartner;
use think\Request;

class Index extends HomeBaseController
{

     public function get_url_all()
    {
        $url = $_SERVER['HTTP_REFERER'];
        $module = Request::instance()->module();
        $array = ['home'=>'home_en','home_en'=>'home'];

        if(!empty($array[$module])){
            $if = strpos($url,$array[$module]);
            if(empty($if)) {$this->redirect('/home_en');}

            $mudule_h = $array[$module];
        }
        $url_h = str_replace($mudule_h,$module,$url);
        $this->redirect($url_h);
    }

    public function index()
    {
		//获取首页banner
		$where_b['banner_type'] = 1;
		$where_b['status'] = 1;
		$where_b['site'] = $this->getsessionbanben();//增加版本
		$banner_info = MBanner::getBannerSelect($where_b,'banner_id,name,con,img_url,point_url,img_url2');
		$this->assign('banner_info',$banner_info);
		$details['a_con'] = "raksmart，美国服务器，香港服务器，日本服务器，服务器租用
，服务器托管";
        	$details['a_introduction'] = "RAKsmart—全球数据中心拥有万兆美服务器，提供DDOS防御、美
国服务器托管及全球IP传输方案。";
        $this->assign('title','服务器托管_服务器租用_IP传输_DDOS防御-RAKsmart全球数据中心，提
供一站式服务。');
		//新闻动态
		$article['info_new'] = $this->getArticleData(19);
		$article['info_zhi'] = $this->getArticleData(20);
		$this->assign('article',$article);
		$this->assign('details',$details);
		//获取合作伙伴
		$map['site'] = $this->getsessionbanben();//增加版本
		$partner = MPartner::getSelect($map,'*','20','listorder asc');
		$this->assign('partner',$partner);

        return $this->fetch('/index');
    }

	//获取对应分类下的文章
	public function getArticleData($c_id)
	{
		//获取所有子分类
		$con['pid'] = $c_id;
		$con['status'] = 1;
		$con['site'] = $this->getsessionbanben();//增加版本
		$ids_info = MArticleCat::getSelect($con);
		$ids = array_column($ids_info,'c_id');
		$ids_name = array_column($ids_info,'c_name','c_id');
		$ids[] = $c_id;

		$where_c['c_id'] = ['in',$ids];
		$where_c['status'] = 1;
		$where_c['site'] = $this->getsessionbanben();//增加版本
		$info_new = MArticle::getSelect($where_c,'a_id,c_id,a_title,a_con,a_updatetime',2,'a_id desc');
		if(!empty($info_new)){
			foreach($info_new as $k=>$v){
				$info_new[$k]['c_name'] = (!empty($ids_name[$v['c_id']]))?$ids_name[$v['c_id']]:'';
			}
		}
		return $info_new;
	}



}
