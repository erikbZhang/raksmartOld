<?php 
namespace app\admin\controller;
use app\common\controller\Base;
use think\Controller;
use think\Cache;
use app\model\MBanner;

class Banner extends Base{

    public function __construct(){
        $user = session('user_info');
        if(!empty($user)) return redirect(url('admin/index/index'));
    }

	/**
	 * 获取轮播图列表 
	 */
	public function index()
	{
		//获取类型
		$data['banner_type'] = lang("banner_type");
		return view('index',$data);
	}
	
	//获取数据
	public function getJsonData()
	{
		$return = ['msg'=>'success','code'=>0,'data'=>[],'count'=>0];
		$page = $_GET['page'];
		$limit = $_GET['limit'];
		$where = $this->getWhere();
		$where['status'] = ['gt','-1'];
		$where['site'] = $this->getsessionbanben();//增加版本
		//获取列表数据
		$res = MBanner::getBannerPage($where,[],$page,$limit,'id desc');
		if($res) $res = $res->toarray();
		if(!empty($res['data'])){
			$return['count'] = $res['total'];
			$return['data'] = $this->clData($res['data']);
		}else{
			$return = ['msg'=>'数据为空','code'=>1,'data'=>[]];
		}
		exit(json_encode($return));
	}
	//处理列表信息
	public function clData($data)
	{
		if(empty($data)) return [];
		$banner_type_arr = lang('banner_type');
		$status = ['0'=>'禁用','1'=>'启用','-1'=>'删除'];
        foreach ($data as $k=>$item) {
            $item['update_time'] = !empty($item['update_time'])?date('Y-m-d H:i',$item['update_time']):'';
            $item['banner_type_name'] = !empty($banner_type_arr[$item['banner_type']])?$banner_type_arr[$item['banner_type']]:'';
			$item['status_name'] = ($item['status']==1)?'启用':'<span style="color:red;">禁用</span>';
			$item['img_url'] = (!empty($item['img_url']))?"<a href='/uploads/".$item['img_url']."' target='_blank' title='点击查看'><img src='/uploads/".$item['img_url']."'/></a>":'';
			$item['img_url2'] = (!empty($item['img_url2']))?"<a href='/uploads/".$item['img_url2']."' target='_blank' title='点击查看'><img src='/uploads/".$item['img_url2']."'/></a>":'';
            $data[$k] = $item;
        }
		return $data;
	}
	
	//处理筛选信息
	public function getWhere()
	{
		$where = [];
		$name       = input('get.name','','trim');
		$banner_type    = input('get.banner_type','','trim');
		$status     = input('get.status','','trim');
		if(!empty($name)) $where['name'] = ['like','%'.$name.'%'];
		if(!empty($banner_type)) $where['banner_type'] = $banner_type;
		if(isset($status)) $where['status'] = ['like','%'.$status.'%'];
		return $where;
	}
	
	
	//添加
	public function add()
	{
		//获取类型
		$data['banner_type'] = lang("banner_type");
		return view('banner_add',$data);
	}
	
	//上传图片
	public function uploadimg()
	{
		$file = request()->file('file');
		// 移动到框架应用根目录/public/uploads/ 目录下
		if($file){
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			if($info){
				// 成功上传后 获取上传信息
				// 输出 jpg
				//$img_url = $info->getExtension();
				$return = ['msg'=>'上传成功','code'=>0,'data'=>['file_url'=>$info->getSaveName()]];//成功
				// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
				//echo $info->getSaveName();
				// 输出 42a79759f284b767dfcb2a0197904287.jpg
				//echo $info->getFilename(); 
			}else{
				// 上传失败获取错误信息
				//echo $file->getError();
				$return = ['msg'=>'上传失败','code'=>199,'data'=>[]];//失败
			}
		}
		echo json_encode($return);exit;
	}
	
	
	//提交数据
	public function submitdata()
	{
        $data = input();
        $check[] = ['action'=>'string','value'=>$data['name']];
        $check[] = ['action'=>'string','value'=>$data['img_url']];
        $check[] = ['action'=>'string','value'=>$data['banner_type']];
        check($check);
		//验证提交的数据
		$add['banner_id']   = create_id();
        $add['banner_type'] = $data['banner_type'];
        $add['name']   		= $data['name'];
        $add['img_url']   	= $data['img_url'];
        $add['img_url2']   	= $data['img_url2'];
        $add['point_url']   = $data['point_url'];
        $add['order_list']  = $data['order_list'];
        $add['con']  = $data['con'];
        $add['update_time'] = time();
		$add['site'] = $this->getsessionbanben();//增加版本
		$res = MBanner::bannerAdd($add);
		ajax_cms($res);
	}
	
	//启用禁用
	public function changeBanner()
	{
		$status = input('status');
		$banner_id = input('banner_id');
		if($status == 1) $up['status'] = 0;
		if($status == 0) $up['status'] = 1;
		$where['banner_id'] = $banner_id;
		$res = MBanner::bannerUpdate($where,$up);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	
	
	//edit
	public function edit()
	{
	    $banner_id = input('banner_id');
		if(empty($banner_id)){ ajax_cms([],'参数错误');exit;}
		//$where['status']  = 1;
		$where['banner_id'] = $banner_id;
		$data['info'] = MBanner::getBannerDetail($where);
		$data['banner_type'] = lang("banner_type");
		return view('banner_edit',$data);
	}
	//submitedit
	public function submitedit()
	{
		$where = [];
		$data = input();
        $check[] = ['action'=>'string','value'=>$data['banner_id']];
        $check[] = ['action'=>'string','value'=>$data['name']];
        $check[] = ['action'=>'string','value'=>$data['img_url']];
        $check[] = ['action'=>'string','value'=>$data['banner_type']];
        check($check);
        //验证提交的数据
        $where['banner_id'] = $data['banner_id'];
        $up['name']   = $data['name'];
        $up['banner_type']   = $data['banner_type'];
        $up['img_url']   = $data['img_url'];
        $up['img_url2']   = $data['img_url2'];
        $up['point_url']   = $data['point_url'];
        $up['order_list']   = $data['order_list'];
        $up['con']   = $data['con'];
        $up['update_time']    = time();
		$res = MBanner::bannerUpdate($where,$up);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	
	
	//删除字典
	public function deleteBanner()
	{
		$banner_id = input('banner_id');
		if(empty($banner_id)) { ajax_cms(false);exit;}
		$where['banner_id'] = $banner_id;
		$up['status'] = '-1';
		$res = MBanner::bannerUpdate($where,$up);
		if($res !== false) ajax_cms(true);
        ajax_cms(false,'保存失败');
	}
	
	
	
	
}