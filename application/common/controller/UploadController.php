<?php 
namespace app\common\controller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\Redis;
class Upload extends Controller 
{
	/**
     * [uploadImg 上传商品图片方法]
     * @return [type] [description]
     */
    public function uploadImg(Request $request)
    {
        if(!$request->hasFile('file'))
        {
            $msg['code'] = 201;
            $msg['msg'] = '上传文件为空！';
            echo json_encode($msg);
        }
        $file = $request->file('file');
        if(!$file->isValid())
        {
            $msg['code'] = 201;
            $msg['msg'] = '文件上传出错！';//判断文件上传过程中是否出错
            echo json_encode($msg);
        }
        $filePath = public_path().'/uploads/yunxun';
        $clientName = $file->getClientOriginalName();//文件名
        $entension = $file->getClientOriginalExtension();//上传文件的后缀
        $fileSize = $file->getSize();
        $filename = md5(time().$clientName).".".$entension;
        if(!$file->move($filePath,$filename))
        {
            $msg['code'] = 201;
            $msg['msg'] = '保存文件失败！';
            $msg['data'] = [
                "src"=> '',
                "file_id" => '',
            ];
            echo json_encode($msg);
        }
        else
        {
            $data['file_name'] = $filename;
            $data['file_true_name'] = $clientName;
            $data['uploader'] = session('user_id');
            $data['file_url'] = '/uploads/yunxun/'.$filename;
            $data['file_size'] = $fileSize;
            $data['file_suffix'] = $entension;
            $data['sign'] = get_sign_key($data);
            $url = Config::get('api.ADMIN_UPLOADIMG');
            $res = $this->commonCurl($url, '', 'post', $data);
            if($res['code'] == 200) $msg['file_id'] = $res['data'];
            else $msg['file_id'] = '';
            $msg['code'] = 0;
            $msg['msg'] = '文件上传成功！';
            $msg['data'] = [
                "src"=> 'http://'.$_SERVER['SERVER_NAME'].$data['file_url'],
                "file_id" => $res['data'],
            ];
            echo json_encode($msg);
        }
    }
	
	public function uploadThumb(Request $request){
        $msg['code'] = 201;
		if(!$request->hasFile('file'))
        {
            $msg['msg'] = '上传文件为空！';
            echo json_encode($msg);
        }
        $file = $request->file('file');
        if(!$file->isValid())
        {            
            $msg['msg'] = '文件上传出错！';//判断文件上传过程中是否出错
            echo json_encode($msg);
        }
        $filesize   = $file->getSize();               //文件大小
        $tmp_name   = $file->getPathname();           //临时文件路径  
        $entension  = $file->getClientOriginalExtension();//上传文件的后缀
        $clientName = $file->getClientOriginalName();//文件名
//        $clientName = rtrim($file->getClientOriginalName(),'.'.$entension);//文件名
        $filename   = md5(time().$clientName).".".$entension;
        $data = [];
        $data['dir']            = $request->input('dir','yun','trim');//文件保存目录
        $data['file_name']      = $filename;
        $data['file_true_name'] = $clientName;
        $data['uploader']       = session('user_id');;
        $data['file_size']      = $filesize;
        $data['file_suffix']    = $entension;
        $data['file_purpose']   = $request->input('file_purpose','6','intval');//文件用途

        // $header = 'content-type:application/x-www-form-urlencoded';
        $fp     = fopen($tmp_name, "rb");
        $data['file_binary']    = base64_encode(fread($fp, $filesize)); //二进制数据流          
        /*
        $file_binary        = base64_encode(file_get_contents($tmp_name)); 
        $data['redis_key']  = Redis::set_redis($file_binary); //redis key值
         */
        unset($file_binary);
        $res = $this->commonCurl(config('api.UPLOAD_THUMB'), '', 'post', $data);         
        if($res['code'] == 200) {          
            $data = $res['data'];
            if(isset($data['file_url'])) {
                $data['src'] = $data['file_url'];
                unset($data['file_url']);
            }
            $msg['data']    = $data;            
            $msg['code']    = 0;            
        }
        else {
            $msg['msg'] = $res['message'];
        }        
        echo json_encode($msg);exit;
	}
	
	
}