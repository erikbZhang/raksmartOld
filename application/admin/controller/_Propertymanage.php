<?php 
namespace app\admin\property\controller;
use think\Controller;

class Propertymanage extends Controller
{
	public function getPropertyList()
	{
		$cache_file = config('datacache');
		$user_admin_info = getCache($cache_file['useradmin']);
		$property_info = getCache($cache_file['property']);
		$community_info = getCache($cache_file['community']);
		$page = input('page') ? input('page') : 1;
		$limit = input('limit') ? input('limit') : 10;
		$start_row = ($page-1) * $limit;
		$end_row = $start_row + ($limit-1);
		$key = input('key/a');
		$data_list = $this->dataList($user_admin_info,$property_info,$community_info);
		$data_search = $this->dataSearch($key,$data_list);//筛选过滤
		$info = $this->dataPage($data_search,$start_row,$end_row);//数据分页
		$data['code'] = 0;
		$data['msg'] = '数据获取成功';
		$data['data'] = $info['data'];
		$data['count'] = $info['count'];
		$data['start_row'] = $start_row;
		$data['end_row'] = $end_row;
		return json($data);
	}

	/**
	 * [dataList 遍历整理所有数据]
	 * @return [type] [description]
	 */
	private function dataList($user_admin_info,$property_info,$community_info)
	{
		$info = [];
		if(!empty($user_admin_info))
		{
			foreach($user_admin_info as $ukey=>$uv)
			{ 
				if($uv['parent'] == '')
				{
					foreach($property_info as $pkey=>$pv)
					{
						if($uv['property_id'] == $pv['property_id']) 
						{
							$info[$ukey]['account'] = $uv['account'];
							if($uv['park_identify'] == 1) $firm = '蓝卡';
							if($uv['park_identify']== 2) $firm = '业德';
							$info[$ukey]['firm'] = $firm;
							$info[$ukey]['property_name'] = $pv['property_name'];
							foreach($community_info as $ckey=>$cv)
							{
								if($uv['property_id'] == $cv['property_id'])
								{
									$info[$ukey]['community_name'] = $cv['community_name'];
									$info[$ukey]['park_id'] = $cv['park_id'];
									$info[$ukey]['community_address'] = $cv['community_address'];
								}
							}
						}
					}
				}
				
			}
		}
		//print_r($info);
		return array_values($info);
	}

	private function dataPage($data,$start_row,$end_row)
	{
		$info = [];
		foreach($data as $key=>$v)
		{
			if($key>=$start_row && $key<=$end_row) $info[] = $v;
		}
		$res['data'] = $info;
		$res['count'] = count($data);
		return $res;
	}

	private function dataSearch($key,$data)
	{
		if(!empty($key))
		{
			if($key['property_name'] != '') $data = $this->propertyNameSearch($key['property_name'],$data);
		}
		return $data;
	}

	private function propertyNameSearch($property_name,$data)
	{
		$new_data_array = [];
		foreach($data as $key=>$v)
		{
			if(strstr($v['property_name'],$property_name) !== false) $new_data_array[] = $v;
		}
		return array_values($new_data_array);
	}
}