<?php
namespace app\home_en\controller;
use think\Controller;
use app\model\MNetwork;
use app\home_en\controller\HomeBaseController;


class Ddos extends HomeBaseController
{
    /*
     * DDOS 防护服务
     * */
    public function index()
    {
		//获取banner
		$this->getBannerDetail(8);
		 $details['a_con'] = "DDOS，高防服务器，CC防御，美国高防服务";
        $details['a_introduction'] = "RAKsmart机房数据中心全球覆盖，可阻止任何类型的DDOS攻击>，提供7*24小时全天候服务，为客户网络资源提供更全面的保护。";
        $this->assign('title','DDOS防御_CC防御_高防服务器-RAKsmart提供1Tbps+DDOS防护解决方案>。');
        $this->assign('details',$details);
        return $this->fetch('/ddos');
    }
    /*
     * IP传输服务
     * */
    public function ipindex()
    {
        //获取banner
        $this->getBannerDetail(9);
	 $details['a_con'] = "IP Transit，IP解决方案，IP传输服务，BGP";
        $details['a_introduction'] = "RAKsmart通过在全球最好的光纤网络提供IP传输服务，RAKsmart在全球提供广阔的覆盖面，多种接口，以提供您的IP传输解决方案。";
        $this->assign('title','IP Transit-RAKsmart拥有全球最好的光纤网络提供IP传输解决方案。');
        $this->assign('details',$details);
        return $this->fetch('/ip');
    }
    /*
     * 全球网络
     * */
    public function globala()
    {
        //获取banner
        $this->getBannerDetail(10);
        //获取全球网络数据
        $where['status'] = ['gt','-1'];
		$where['site'] = $this->getsessionbanben();//增加版本
        $res = MNetwork::getSelect($where,'*','10');//最多调取10条数据
        $network = $this->clData($res);
        $this->assign('network',$network);
	$details['a_con'] = "BGP网络，网络全球化，raksmart";
        $details['a_introduction'] = "RAKsmart—全球数据中心拥有万兆美服务器，提供DDOS防御、美
国服务器托管及全球IP传输方案。";
        $this->assign('title','全球网络-RAKsmart网络全球化，提供最快速、稳定、可靠的网络。');
        $this->assign('details',$details);
        return $this->fetch('/global');
    }
    /*
     *sdwan
     * */
    public function sdwan()
    {
        //获取banner
        $this->getBannerDetail(12);
        $details['a_con'] = "SD-WAN，云+网服务，智能网络，SDN";
        $details['a_introduction'] = "RAKsmart—全球拥有200多个POP节点，为您提供智能的网络运营
商，帮您轻松应对业务挑战，解决企业通点。";
        $this->assign('title','SD-WAN_智能网络——RAKsmart提供专业、强大的云+网链接平台');
        $this->assign('details',$details);
	return $this->fetch('/sdwan');
    }

    public function clData($data)
    {
        if(empty($data)) return [];
        $type_network = lang('type_network');
        foreach ($data as $k=>$item) {
            $name = '';
            if(!empty($item['w_operator'])){
                $w_operator = explode(',',$item['w_operator']);
                foreach($w_operator as $kk=>$v){
                    $name .= (!empty($type_network[$v]))?$type_network[$v].'、':'';
                }
            }
            $data[$k]['w_operator_name'] = trim($name,'、');
            $data[$k]['addtime'] = !empty($item['addtime'])?date('Y-m-d H:i',$item['addtime']):'';
        }
        return $data;
    }

    /*
     * network
     * */
    public function network()
    {
        //获取banner
        $this->getBannerDetail(16);
	$details['a_con'] = "raksmart，美国服务器，香港服务器，日本服务器，服务器租用，服务器
托管";
        $details['a_introduction'] = "RAKsmart—全球数据中心拥有万兆美服务器，提供DDOS防御、美
国服务器托管及全球IP传输方案。";
        $this->assign('title','Network peering-RAKsmart全球服务中心，提供一站式服务。');
        $this->assign('details',$details);
        return $this->fetch('/network');
    }





}
