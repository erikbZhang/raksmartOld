<?php


namespace app\home\controller;

use think\Controller;
use app\model\MArticle;
use app\model\MArticleCat;
use think\Request;

class Errors extends Controller
{

    public function  index(Request $request){
//		echo "<pre>";
        $server  = $request->server();
	$url = "https://".$server['HTTP_HOST'].$server['REQUEST_URI'];
        if(empty($url)) $this->error('数据错误');
        $where['a_url'] = $url;
        $where['status'] = 1;
        $details = MArticle::getDetail($where);
//var_dump($details);die;
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
//        echo "<pre>";
//        var_dump($pre,$next);die;
        $this->assign('details',$details);
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('type',$type);
        $this->assign('bg3','1');//控制导航样式
        $this->assign('title',$details['a_title']);

        return  $this->fetch('../../../template/articles');
    }

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
        $ids_info = MArticleCat::getSelect($con);
        $ids = array_column($ids_info,'c_id');
        $ids[] = $type;

        $map['c_id'] = ['in',$ids];//只有新闻中心和知识库
        $map['a_id'] = [$fh,$details['a_id']];
        $map['status'] = 1;
        $info = MArticle::getDetail($map,'*',$order);
        return $info;
    }
}
