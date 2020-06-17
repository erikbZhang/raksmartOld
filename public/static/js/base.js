/**
* 消息提示 
* @param msg 消息内容
* @param bool true成功提示;false错误提示
* @param func 回调函数
*/
function show_msg(msg,bool,func){
	layer.closeAll('loading'); //关闭加载层
	var type = bool == true || (!bool && bool !==false) ?1:2;
	layer.msg(msg,{icon:type,time:1200},function(){
		if(typeof(func) == 'function') func();
	});
}

/**
* 消息提示 
* @param msg 消息内容
* @param func 回调函数
*/
function show_confirm(msg,func){	
	layer.confirm(msg, function(index) {  
	   if(typeof(func) == 'function') func();
	});
}

$(function(){
	$('a#cancel').click(function(){
		parent.layer.closeAll();
	});
	
	$('a[lay-src]').click(function(){
		var val = $(this).attr('lay-src');
		if(val.length == 0) return false;
		$.post(val,function(res){
			if(res.code == 0) show_msg(res.msg,true);
			else show_msg(res.msg,false);
		},'json');
		parent.layer.closeAll();
	});
	
	 $(document).on('blur', 'input[data-href]', function() {
		var that = $(this);
		var ajaxUrl = that.data('href');
		layer.load(1);
		$.post(ajaxUrl, {value : that.val(),field:that.data('field')}, function(res) {				
				layer.closeAll();
			
		}, 'json');
	});
});