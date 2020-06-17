layui.use(['form'], function(){
var $ = layui.$
,form = layui.form;
form.render();
//用户登录
form.on('submit(LAY-user-login-submit)', function(obj){			
	 $.post('/admin/user/login',obj.field,function(res){
		 if(res.code == 0) {
			show_msg('登录成功 请稍等...',true,function(){
				location.href = "/admin/index/index";
			});
			return false;
		 }
		 show_msg(res.msg,false);
	 },'json');	 
  
});
});