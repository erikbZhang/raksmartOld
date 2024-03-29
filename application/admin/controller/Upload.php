<?php 
namespace app\admin\controller;
use app\common\controller\Base;
class Upload extends Base{
    public function uploads()
	{
		header("content-type:text/html;charset=utf-8"); 
		//获取文件的大小  
		$file_size=$_FILES['file']['size'];  
		if($file_size>2*1024*1024) {  
			echo "文件过大，不能上传大于2M的文件";  
			exit();  
		}  
		$file_type=$_FILES['file']['type'];
		/* if($file_type!="image/jpeg" && $file_type!='image/pjpeg') {  
			echo "文件类型只能为jpg格式";  
			exit();  
		} */
		$timedate = date('Ymd',time());
		$user_path=$_SERVER['DOCUMENT_ROOT']."\uploads"."\\".$timedate; 
		$tmp_name = $_FILES['file']['tmp_name'];
		$name = $_FILES['file']['name'];
		$adr=time().rand(1,1000).substr($name,strrpos($name,"."));
		$move_to_file=$user_path."/".$adr;
		if(!file_exists($user_path)) {  
			mkdir(iconv('utf-8', 'gbk',$user_path),0777,true);  
		}
		if(move_uploaded_file($tmp_name,iconv("utf-8","gb2312",$move_to_file))) {
			$msg['code'] = 0;
            $msg['msg'] = '上传成功';
			$msg['data'] = '/uploads/'.$timedate.'/'.$adr;
			//是否加水印
			if(!empty($_GET['water']) && $_GET['water'] == 1){
				$this->setWater('uploads/'.$timedate.'/'.$adr,'uploads/shui.png');
			}
            echo json_encode($msg);exit;			
		} else {  
			$msg['code'] = 201;
            $msg['msg'] = '上传失败';
            echo json_encode($msg);exit;
		}  
	}
	
	public function shuiyin()
	{
		$img = 'uploads/20191204/1575430391610.jpeg';
		$img_a = 'uploads/shui.png';
		
		$this->setWater($img,$img_a);
	}
	
	/* 
	 * 支持以图片和文字两种方式给图片添加水印。图片支持GIF,PNG,JPG三种格式，水印图片支持PNG和GIF 
	 *	$imgSrc：目标图片，可带相对目录地址，
	 *	$markImg：水印图片，可带相对目录地址，支持PNG和GIF两种格式，如水印图片在执行文件mark目录下，可写成：mark/mark.gif
	 *	$markText：给图片添加的水印文字
	 *	$TextColor：水印文字的字体颜色
	 *	$markPos：图片水印添加的位置，取值范围：0~9
		0：随机位置，在1~8之间随机选取一个位置
		1：顶部居左 2：顶部居中 3：顶部居右 4：左边居中
		5：图片中心 6：右边居中 7：底部居左 8：底部居中 9：底部居右
	 *	$fontType：具体的字体库，可带相对目录地址
	 *	$markType：图片添加水印的方式，img代表以图片方式，text代表以文字方式添加水印
	 */
	public function setWater($imgSrc,$markImg,$markText='',$TextColor='',$markPos=5,$fontType='',$markType='img')
	{
	  $srcInfo = @getimagesize($imgSrc);
	  $srcImg_w  = $srcInfo[0];
	  $srcImg_h  = $srcInfo[1];
	  switch ($srcInfo[2]) 

	  { 

		case 1: 

		  $srcim =imagecreatefromgif($imgSrc); 

		  break; 

		case 2: 

		  $srcim =imagecreatefromjpeg($imgSrc); 

		  break; 

		case 3: 

		  $srcim =imagecreatefrompng($imgSrc); 

		  break; 

		default: 

		  die("不支持的图片文件类型"); 

		  exit; 

	  }

		 

	  if(!strcmp($markType,"img"))

	  {

		if(!file_exists($markImg) || empty($markImg))

		{

		  return;

		}

		   

		$markImgInfo = @getimagesize($markImg);

		$markImg_w  = $markImgInfo[0];

		$markImg_h  = $markImgInfo[1];

		   

		if($srcImg_w < $markImg_w || $srcImg_h < $markImg_h)

		{

		  return;

		}

		   

		switch ($markImgInfo[2]) 

		{ 

		  case 1: 

			$markim =imagecreatefromgif($markImg); 

			break; 

		  case 2: 

			$markim =imagecreatefromjpeg($markImg); 

			break; 

		  case 3: 

			$markim =imagecreatefrompng($markImg); 

			break; 

		  default: 

			die("不支持的水印图片文件类型"); 

			exit; 

		}

		   

		$logow = $markImg_w;

		$logoh = $markImg_h;

	  }

		 

	  if(!strcmp($markType,"text"))

	  {

		$fontSize = 16;

		if(!empty($markText))

		{

		  if(!file_exists($fontType))

		  {

			return;

		  }

		}

		else {

		  return;

		}

		   

		$box = @imagettfbbox($fontSize, 0, $fontType,$markText);

		$logow = max($box[2], $box[4]) - min($box[0], $box[6]);

		$logoh = max($box[1], $box[3]) - min($box[5], $box[7]);

	  }

		 

	  if($markPos == 0)

	  {

		$markPos = rand(1, 9);

	  }

		 

	  switch($markPos)

	  {

		case 1:

		  $x = +5;

		  $y = +5;

		  break;

		case 2:

		  $x = ($srcImg_w - $logow) / 2;

		  $y = +5;

		  break;

		case 3:

		  $x = $srcImg_w - $logow - 5;

		  $y = +15;

		  break;

		case 4:

		  $x = +5;

		  $y = ($srcImg_h - $logoh) / 2;

		  break;

		case 5:

		  $x = ($srcImg_w - $logow) / 2;

		  $y = ($srcImg_h - $logoh) / 2;

		  break;

		case 6:

		  $x = $srcImg_w - $logow - 5;

		  $y = ($srcImg_h - $logoh) / 2;

		  break;

		case 7:

		  $x = +5;

		  $y = $srcImg_h - $logoh - 5;

		  break;

		case 8:

		  $x = ($srcImg_w - $logow) / 2;

		  $y = $srcImg_h - $logoh - 5;

		  break;

		case 9:

		  $x = $srcImg_w - $logow - 5;

		  $y = $srcImg_h - $logoh -5;

		  break;

		default: 

		  die("此位置不支持"); 

		  exit;

	  }

		 

	  $dst_img = @imagecreatetruecolor($srcImg_w, $srcImg_h);

		 

	  imagecopy ( $dst_img, $srcim, 0, 0, 0, 0, $srcImg_w, $srcImg_h);

		 

	  if(!strcmp($markType,"img"))

	  {

		imagecopy($dst_img, $markim, $x, $y, 0, 0, $logow, $logoh);

		imagedestroy($markim);

	  }

		 

	  if(!strcmp($markType,"text"))

	  {

		$rgb = explode(',', $TextColor);

		   

		$color = imagecolorallocate($dst_img, $rgb[0], $rgb[1], $rgb[2]);

		imagettftext($dst_img, $fontSize, 0, $x, $y, $color, $fontType,$markText);

	  }

		 

	  switch ($srcInfo[2]) 

	  { 

		case 1:

		  imagegif($dst_img, $imgSrc); 

		  break; 

		case 2: 

		  imagejpeg($dst_img, $imgSrc); 

		  break; 

		case 3: 

		  imagepng($dst_img, $imgSrc); 

		  break;

		default: 

		  die("不支持的水印图片文件类型"); 

		  exit; 

	  }

		

	  imagedestroy($dst_img);

	  imagedestroy($srcim);

	}
	
	
	
	
}