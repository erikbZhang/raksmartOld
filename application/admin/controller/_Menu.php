<?php
namespace app\admin\controller;
use app\admin\common\controller\Base;
use app\model\system\MMenu;

class Menu extends Base{

	private $code;
	private $page;
	private $rows;
	private $form_data;
	private $return_data;

	public function __construct()
	{
		parent::__construct();
		$this->code = 199;
		$this->page = input('page') ? input('page') : 1;
		$this->rows = input('rows') ? input('rows') : 10;
		$this->form_data = input('form_data');
		if(!empty($this->form_data)) $this->form_data = json_decode($this->form_data,true);
		else $this->form_data = [];
		$this->return_data = [];
	}


	/**
	 * [addMenu 新增菜单]
	 */
	public function addMenu()
	{
		$menu_name = $this->form_data['menu_name'] ? $this->form_data['menu_name'] : '';
		$menu_url = $this->form_data['menu_url'] ? $this->form_data['menu_url'] : '';
		$message = getLang('system','SUCCESS');
		if($menu_name == '' || $menu_url == '') $message = getLang('system','MENU_INFO_MISS');
		else
		{
			$where['menu_url'] = $menu_url;
			$where['status'] = 1;
			$get_menu_info = MMenu::getMenuInfo($where);//重复数据检测
			if($get_menu_info) $message = getLang('system','MENU_INFO_EXIST');
			else
			{
				$insert_data['menu_name'] = $menu_name;
				$insert_data['menu_url'] = $menu_url;
				$insert_data['menu_id'] = getRand();
				$add_menu = MMenu::addMenu($insert_data);//新增菜单
				if($add_menu)
				{
					$message = getLang('system','MENU_ADD_SUCCESS');
					$this->code = 200;
					$this->return_data = $insert_data;
				}
				else $message = getLang('system','MENU_ADD_FAIL');
			}
		}
		$res['code'] = $this->code;
		$res['message'] = $message;
		$res['data'] = $this->return_data;
		return json($res);
	}

	public function deleteMenu()
	{
		$menu_id = $this->form_data['menu_id'];
		if($menu_id == '') getLang('system','MENU_ID_MISSING');
		else
		{
			$where['menu_id'] = $menu_id;
			$udpate['status'] = -1;
			$delete_menu = MMenu::deleteMenu($where,$udpate);
			if($delete_menu) 
			{
				$this->code = 200;
				$message = getLang('system','MENU_DELETE_SUCCESS');
			}
			else $message = getLang('system','MENU_DELETE_FAIL');
		}
		$res['code'] = $this->code;
		$res['message'] = $message;
		$res['data'] = $this->return_data;
		return json($res);
	}


	public function getMenuList()
	{
		$where['status'] = 1;
		$this->return_data = MMenu::getMenuList($where);
		$data['code'] = 0;
		$data['msg'] = getLang('system','MENU_INFO_GETTED');
		$data['data'] = $this->return_data;
		$data['count'] = count($this->return_data);
		return json($data);
	}
}