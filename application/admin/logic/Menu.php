<?php
namespace app\admin\logic;
use think\Db;
class Menu
{
	
	 /**
     * [getMenuTree 格式化菜单树]
     * @param  [type] $menu [description]
     * @return [type]       [description]
     */
    public function getMenuTree($menu,$checked = [])
    {
        $info = $top = $sec = $thd = [];		
		//菜单分类
        foreach($menu as $key=>$v)
        {
            if($v['level'] == 1) $top[] = $v;
            if($v['level'] == 2) $sec[] = $v;
            if($v['level'] == 3) $thd[] = $v;
        }
        //一级菜单格式化
        foreach($top as $key=>$v)
        {
            $info[$key]['name'] = $v['menu_name'];
            $info[$key]['id'] = $v['id'];
            $info[$key]['open'] = true;
            if(in_array($v['id'], $checked)) $info[$key]['checked'] = true;
            foreach($sec as $skey=>$sv)
            {
                if($sv['parent'] == $v['id'])
                {
                    $arry['name']       = $sv['menu_name'];
                    $arry['id']         = $sv['id'];
                    $arry['open']       = true;
                    $arry['children']   = [];
                    $arry['checked']    = in_array($sv['id'], $checked)? true : false;
                    foreach($thd as $tkey=>$tv)
                    {
                        if($tv['parent'] == $sv['id'])
                        {
                            $arry['children'][$tkey]['name'] = $tv['menu_name'];
                            $arry['children'][$tkey]['id'] = $tv['id'];
                            $arry['children'][$tkey]['isParent'] = false;
                            $arry['children'][$tkey]['checked'] = in_array($tv['id'], $checked) ? true : false;
                            unset($thd[$tkey]);
                        }
                    }
                    $arry['children'] = array_values($arry['children']);
                    $info[$key]['children'][$skey] = $arry;
                    unset($sec[$skey]);
                }
            }
            $info[$key]['children'] = array_values($info[$key]['children']);
        }
        $info = array_values($info);
        unset($menu, $top, $sec, $thd);
        return $info;
    }
}