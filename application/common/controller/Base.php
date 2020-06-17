<?php 
namespace app\common\controller;
use think\Controller;

class Base extends Controller
{

	public function __construct()
	{
		parent::_initialize();
		$this->sessionCheck();
		$this->getsessionbanben();
	}


	/**
	 * [sessionCheck 用户session信息检测]
	 * @return [type] [description]
	 */
	private function sessionCheck()
	{
		$user = session('user_info');
		if(!empty($user)) return true;
        return $this->redirect('/admin/user/login');
	}
	
	//获取版本切换
	public function getsessionbanben()
	{
		$banben_english = session('banben_english');
		if(!empty($banben_english)) return $banben_english;
        else return 1;
	}
	
}