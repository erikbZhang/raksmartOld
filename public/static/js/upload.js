layui.config({
      base: '/static/layuiadmin/' //静态资源所在路径
  }).extend({
	 index: 'lib/index' //主入口模块
  }).use(['index', 'upload','form','laydate'], function(){
	 var $ = layui.jquery
	 ,upload = layui.upload;
	 var form = layui.form;
	 var laydate = layui.laydate;
	  //日期
	  laydate.render({
		elem: '#start_time'
	  });
	  laydate.render({
		elem: '#end_time'
	  });
	 
	 
	  //多文件列表示例
    form.render('checkbox');//多选
	var demoListView = $('#test-upload-demoList')
    ,uploadListIns = upload.render({
      elem: '#test-upload-testList'
      ,url: '/admin/upload/uploads?water=1'
      ,accept: 'file'
      ,multiple: true
      ,auto: false
      ,bindAction: '#test-upload-testListAction'
      ,choose: function(obj){   
        var files = this.files = obj.pushFile(); //将每次选择的文件追加到文件队列
        //读取本地文件
        obj.preview(function(index, file, result){
		
			if(/^image/.test(file.type)){
						str = '<img width="75" height="75" src="'+ result +'" alt="'+ file.name +'">';
					}
          var tr = $(['<tr id="upload-'+ index +'">'
            //,'<td>'+ file.name +'</td>'
            ,'<td>'+ str +'</td>'
            ,'<td>'+ (file.size/1014).toFixed(1) +'kb</td>'
            ,'<td>等待上传</td>'
            ,'<td>'
              ,'<button class="layui-btn layui-btn-mini test-upload-demo-reload layui-hide">重传</button>'
              ,'<button class="layui-btn layui-btn-mini layui-btn-danger test-upload-demo-delete">删除</button>'
            ,'</td>'
          ,'</tr>'].join(''));
          
          //单个重传
          tr.find('.test-upload-demo-reload').on('click', function(){
            obj.upload(index, file);
          });
          
          //删除
          tr.find('.test-upload-demo-delete').on('click', function(){
            delete files[index]; //删除对应的文件
            tr.remove();
            uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选
          });
          
          demoListView.append(tr);
        });
      }
      ,done: function(res, index, upload){
        if(res.code == 0){ //上传成功
          var tr = demoListView.find('tr#upload-'+ index)
          ,tds = tr.children();
          tds.eq(2).html('<input type="hidden" name="img[]" value="'+ res.data +'"><span style="color: #5FB878;">上传成功</span>');
          tds.eq(3).html(''); //清空操作
          return delete this.files[index]; //删除文件队列已经上传成功的文件
        }
        this.error(index, upload);
      }
      ,error: function(index, upload){
        var tr = demoListView.find('tr#upload-'+ index)
        ,tds = tr.children();
        tds.eq(2).html('<span style="color: #FF5722;">上传失败</span>');
        tds.eq(3).find('.test-upload-demo-reload').removeClass('layui-hide'); //显示重传
      }
    });
	
	//设备图集
	var demoListViewaaa = $('#shebei')
    ,uploadListIns = upload.render({
      elem: '#sb-test-upload-testList'
      ,url: '/admin/upload/uploads'
      ,accept: 'file'
      ,multiple: true
      ,auto: false
      ,bindAction: '#test-upload-testListAction-two'
      ,choose: function(obj){   
        var files = this.files = obj.pushFile(); //将每次选择的文件追加到文件队列
        //读取本地文件
        obj.preview(function(index, file, result){
		
			if(/^image/.test(file.type)){
						str = '<img width="75" height="75" src="'+ result +'" alt="'+ file.name +'">';
					}
          var tr = $(['<tr id="upload-'+ index +'">'
            //,'<td>'+ file.name +'</td>'
            ,'<td>'+ str +'</td>'
            ,'<td>'+ (file.size/1014).toFixed(1) +'kb</td>'
            ,'<td>等待上传</td>'
            ,'<td>'
              ,'<button class="layui-btn layui-btn-mini test-upload-demo-reload layui-hide">重传</button>'
              ,'<button class="layui-btn layui-btn-mini layui-btn-danger test-upload-demo-delete">删除</button>'
            ,'</td>'
          ,'</tr>'].join(''));
          
          //单个重传
          tr.find('.test-upload-demo-reload').on('click', function(){
            obj.upload(index, file);
          });
          
          //删除
          tr.find('.test-upload-demo-delete').on('click', function(){
            delete files[index]; //删除对应的文件
            tr.remove();
            uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选
          });
          
          demoListViewaaa.append(tr);
        });
      }
      ,done: function(res, index, upload){
        if(res.code == 0){ //上传成功
          var tr = demoListViewaaa.find('tr#upload-'+ index)
          ,tds = tr.children();
          tds.eq(2).html('<input type="hidden" name="img_two[]" value="'+ res.data +'"><span style="color: #5FB878;">上传成功</span>');
          tds.eq(3).html(''); //清空操作
          return delete this.files[index]; //删除文件队列已经上传成功的文件
        }
        this.error(index, upload);
      }
      ,error: function(index, upload){
        var tr = demoListViewaaa.find('tr#upload-'+ index)
        ,tds = tr.children();
        tds.eq(2).html('<span style="color: #FF5722;">上传失败</span>');
        tds.eq(3).find('.test-upload-demo-reload').removeClass('layui-hide'); //显示重传
      }
    });
		
		
		//提交
		$('#submit').click(function () {
            var obj = $(this);
            var community_id  = $('input[name="community_id"]').val();
            if(community_id == ''){
                layer.msg('数据错误！',{icon:2});
                return false;
            }
			var formData = $("#myForm").serialize();
            obj.attr('disabled',true);
            $.ajax({
                type:"POST",
                url:'/admin/community/submitdata',
                data:formData,
                dataType:"JSON",
                success:function(data){
                    console.log(data);
                    if(data.code == 200)
                    {
                        layer.msg('保存成功！',{icon:1,time: 2000},function(){
                            window.parent.location.reload();//刷新父页面
                            parent.layer.closeAll();
                        });
                    }
                    else{
                        obj.attr('disabled',false);
                        layer.msg(data.message,{icon:2}, function(){ /*window.parent.location.reload();parent.layer.closeAll(); */});
                    }
                }
            });
        });
		
		
  
  });