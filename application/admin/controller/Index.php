<?php
namespace app\admin\controller;
use app\common\controller\Base;
use app\model\MIndex;
use app\model\MMember;
use think\Controller;
class Index extends Base
{
    public function index()
    {

        return view();
    }

    public function home()
    {
        $info['user_count'] = $this->getUserCount();
		return view('',['info'=>$info]);
    }

    public function dataCache()
    {
        return view('dataCache');
    }

    /**
     * [dataCache 将基础信息缓存到本地文件避免多次查询数据]
     * @return [type] [description]
     */
    public function makeDataCache()
    {
        $cache_file = config('datacache');
        //缓存物业信息
        $this->makeCacheProperty($cache_file['property']);
        //缓存社区信息
        $this->makeCacheCommunity($cache_file['community']);
        //缓存物业账号信息
        $this->makeCacheUserAdmin($cache_file['useradmin']);
        return json(['code'=>200]);
    }


    private function makeCacheUserAdmin($filename)
    {
        $user_admin = $this->getUserAdminInfo();
        if(!empty($user_admin))
        {
            $json_user_admin_array = [];
            foreach($user_admin as $key=>$v)
            {
                $json_user_admin_array[$key]['user_id'] = $v['user_id'];
                $json_user_admin_array[$key]['account'] = $v['account'];
                $json_user_admin_array[$key]['park_identify'] = $v['park_identify'];
                $json_user_admin_array[$key]['property_id'] = $v['property_id'];
                $json_user_admin_array[$key]['parent'] = $v['parent'];
                $json_user_admin_array[$key]['status'] = $v['status'];
            }
            makeCache($filename,json_encode($json_user_admin_array));
        }
    }

    private function makeCacheProperty($filename)
    {
        $property_info = $this->getPropertyInfo();
        if(!empty($property_info))
        {
            $json_property_info_array = [];
            foreach($property_info as $key=>$v)
            {
                $json_property_info_array[$key]['property_id'] = $v['property_id'];
                $json_property_info_array[$key]['property_name'] = $v['property_name'];
            }
            makeCache($filename,json_encode($json_property_info_array));
        }
    }

    private function makeCacheCommunity($filename)
    {
        $community_info = $this->getCommunityInfo();
        if(!empty($community_info))
        {
            $json_community_info_array = [];
            foreach($community_info as $key=>$v)
            {
                $json_community_info_array[$key]['property_id'] = $v['property_id'];
                $json_community_info_array[$key]['community_id'] = $v['community_id'];
                $json_community_info_array[$key]['community_name'] = $v['community_name'];
                $json_community_info_array[$key]['community_address'] = $v['community_address'];
                $json_community_info_array[$key]['park_id'] = $v['park_id'];
            }
            makeCache($filename,json_encode($json_community_info_array));
        }
    }


    private function getUserAdminInfo()
    {
        $where['status'] = 1;
        $res = MIndex::getUserAdminInfo($where);
        return $res;
    }

    private function getPropertyInfo()
    {
        $where['status'] = 1;
        $res = MIndex::getPropertyInfo($where);
        return $res;
    }


    private function getCommunityInfo()
    {
        $res = MIndex::getCommunityInfo();
        return $res;
    }


    /*
     * 注册用户数量
     * */
    private function getUserCount()
    {
        $where['status'] = 1;
        $res = MMember::toCount($where);
        if(!$res) $res = 0;
        return $res;
    }

    private function getUserCarCount()
    {
        $where['status'] = 1;
        $res = MIndex::getUserCarCount($where);
        if(!$res) $res = 0;
        return $res;
    }

    private function getUserEstateCount()
    {
        $where['status'] = 1;
        $res = MIndex::getUserEstateCount($where);
        if(!$res) $res = 0;
        return $res;
    }

    private function getCommunityCount()
    {
        $res = MIndex::getCommunityCount('1=1');
        if(!$res) $res = 0;
        return $res;
    }

    private function getUserCarNumCount()
    {
        $where['status'] = ['neq',-1];
        $res = MIndex::getUserCarNumCount($where);
        return $res;
    }

    private function getpropertyUserCount()
    {
        $where['status'] = 1;
        $res = MIndex::getpropertyUserCount($where);
        return $res;
    }
}

