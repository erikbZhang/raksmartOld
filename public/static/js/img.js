var uploads = {
    options:{
        eme:'#testList',
        up_type:'img',
        accept:'images',
        exts:'jpg|jpeg|bmp|gif|png',
        size:1000, //限制文件大小，单位 KB
        url:'/admin/banner/uploadimg',
        name:'img_url',//保存上传后文件url的隐藏域
    },
	/*
	 init:function(ops,eme){
	 if(eme) uploads.eme = eme;
	 uploads.options = $.extend(uploads.options,ops);
	 },
	 */
    uploadimgs:function (ops){
        var up = $.extend({},uploads.options,ops);
        layui.use('upload', function() {
            var $ = layui.jquery;
            upload = layui.upload;
            var demoListView = $(up.showobj),
                uploadListIns = upload.render({
                    elem: up.eme,
                    url: up.url,
                    accept: up.accept,
                    //field: up.name,
                    multiple: true,
                    auto: false,
                    bindAction: up.bindObj,
                    choose: function(obj){
                        //将每次选择的文件追加到文件队列
                        var files = this.files = obj.pushFile();
                        //读取本地文件
                        obj.preview(function(index, file, result){
                            var str = file.name;
                            if(/^image/.test(file.type)){
                                str = '<img width="75" height="75" src="'+ result +'" alt="'+ file.name +'">';
                            }
                            var tr = $(['<tr id="upload-'+ index +'">'
                                ,'<td><input type="hidden" name="'+up.name+'['+index+'][file]">'+str+'</td>'
                                ,'<td class="td-listorder"><input type="text" name="'+up.name+'['+index+'][listorder]" value="0" style="width:55px;" class="layui-input"></td>'
                                //,'<td>'+ (file.size/1014).toFixed(1) +'kb</td>'
                                ,'<td>等待上传</td>'
                                ,'<td>'
                                ,'<button type="button" class="layui-btn layui-btn-mini demo-reload layui-hide">重传</button>'
                                ,'<button type="button" class="layui-btn layui-btn-mini layui-btn-danger demo-delete">删除</button>'
                                ,'</td>'
                                ,'</tr>'].join(''));
                            //单个重传
                            tr.find('.demo-reload').on('click', function(){
                                obj.upload(index, file);
                            });

                            //删除
                            tr.find('.demo-delete').on('click', function(){
                                delete files[index]; //删除对应的文件
                                tr.remove();
                                uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选
                            });

                            demoListView.append(tr);
                        });
                    },
                    done: function(res, index, upload){
                        if(res.code == 0){ //上传成功
                            var tr = demoListView.find('tr#upload-'+ index)
                                ,tds = tr.children();
                            tr.find('input:hidden').val(res.data.file_url);
                            tds.eq(2).html('<span style="color: #5FB878;">上传成功</span>');
                            //tds.eq(2).html('&nbsp;'); //清空操作
                            return delete this.files[index]; //删除文件队列已经上传成功的文件
                        }
                        this.error(index, upload);
                    },
                    error: function(index, upload){
                        var tr = demoListView.find('tr#upload-'+ index)
                            ,tds = tr.children();
                        tds.eq(1).html('<span style="color: #FF5722;">上传失败</span>');
                        tds.eq(2).find('.demo-reload').removeClass('layui-hide'); //显示重传
                    }
                });
        });
    },
	oneimg:function(ops){
        var up = $.extend({},uploads.options,ops);
        layui.use(['layer','upload'],function(){
            var $ = layui.$ //重点处
            var layer = layui.layer;
            var uploadInst = layui.upload.render({
                elem: up.eme,
                url: up.url,
                accept: up.accept,
                exts: up.exts,
                size: up.size,
                multiple: false,
                field: 'file',
                // data: {type:up.up_type},
                before: function(obj){
                    obj.preview(function(index, file, result){
                        $('#demo1').attr('src', result); //图片链接（base64）
                    });
                },
                done: function(res){
                    if(res.code == 0) {
                       var data = res.data;
                        var val ='';
						val = data.file_url;
                        $('#'+up.name).val(val);
                        return true;
                    }
                    return layer.msg(res.msg,{icon:2});
                },
                error: function(){
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function(){
                        uploadInst.upload();
                    });
                }
            });
        });
    },
	oneimg2:function(ops){
        var up = $.extend({},uploads.options,ops);
        layui.use(['layer','upload'],function(){
            var $ = layui.$ //重点处
            var layer = layui.layer;
            var uploadInst = layui.upload.render({
                elem: testList2,
                url: up.url,
                accept: up.accept,
                exts: up.exts,
                size: up.size,
                multiple: false,
                field: 'file',
                // data: {type:up.up_type},
                before: function(obj){
                    obj.preview(function(index, file, result){
                        $('#demo2').attr('src', result); //图片链接（base64）
                    });
                },
                done: function(res){
                    if(res.code == 0) {
                       var data = res.data;
                        var val ='';
						val = data.file_url;
                        $('#img_url2').val(val);
                        return true;
                    }
                    return layer.msg(res.msg,{icon:2});
                },
                error: function(){
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function(){
                        uploadInst.upload();
                    });
                }
            });
        });
    }
};

var open = "/image/open.gif",close = '/image/close.gif';
function displayData(self)
{
    self = $(self);
    var objtr = self.closest('tr');
    var pid = objtr.attr('id');
    var status=1;
    if(self.data('status') == 1) status = 0;
    jqshow(pid,status);
    self.data('status',status);
    $(self).attr("src",status==1?open:close);
}

function jqshow(id,status) {
    var obj = $(".cat-list tr[data-pid='"+id+"']");
    if(obj.length == 0) return false;
    obj.each(function(i) {
        jqshow($(this).attr('id'),status);
    });
    if(status==0) {
        $(obj).show().find('.operator').attr("src",close);
    }else {
        $(obj).hide().find('.operator').attr("src",open);
    }
}