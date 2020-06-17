<?php
namespace app\home\controller;
use think\Controller;
use app\model\MConfiguration;
use app\model\MConfigurationType;

class Privatea extends HomeBaseController
{
    /*
     * 私有云
     * */
    public function index()
    {
		//获取banner
		$this->getBannerDetail(6);
		$this->getBannerSelect(7,'banner_info_two');
             	 $details['a_con'] = "私有云，什么是私有云，私有云服务，raksmart";
        $details['a_introduction'] = "RAKsmart帮助用户建设与运维管理、托管私有云专家为用户提供一站式私有云方案咨询设计、实施部署、运维管理与扩容优化服务";
        $this->assign('title','私有云_什么是私有云-RAKsmart提供一站式全方位私有云解决方案。');
        $this->assign('details',$details);
		return $this->fetch('/private');
    }

    public function getConfigulationType()
    {
        $where['status'] = 1;
		$where['site'] = $this->getsessionbanben();//增加版本
        $data = MConfigurationType::getSelect($where,'*','id desc');
        return $data;
    }
    /*
     * 公有云
     * */
    public function publicindex()
    {
	 $details['a_con'] = "公有云，VPS，美国VPS，香港VPS，日本VPS
";
        $details['a_introduction'] = "RAKsmart通过独特的裸机云配置产品，提供快速，稳定，安全的云计算产品。";
        $this->assign('title','美国VPS_香港VPS_日本VPS_CN2VPS-RAKsmart全球数据中心。');
        $this->assign('details',$details);
	//获取banner
        $this->getBannerDetail(14);
        //公有云配置产品
        $type = $this->getConfigulationType();//lang('dictionaries_type');
        //获取分类下的产品，最多十条数据
        $arr = [];
        if(!empty($type)){
            $where['status'] = 1;
            foreach ($type as $k=>$v) {
                $where['type'] = $v['id'];
                $array = MConfiguration::getSelect($where,'*','100');
                $info = isset($array)?$array:'';
                $type = $v;
		foreach ($info as $val){
                    if($val['system'] == 'Windows'){
                        $windows[] = $val;
                    }
                    if($val['system'] == 'Linux'){
                        $linux[] = $val;
                    }
                }

                $info = array_merge($windows,$linux);
		 $windows = [];
                $linux = [];
                $arr[] = ['type'=>$v['id'],'type_name'=>$v['name'],'info'=>$info];
            }
        }
        $this->assign('data',$arr);
        $this->assign('product_name','公有云配置产品');
        return $this->fetch('/public');
    }








}
