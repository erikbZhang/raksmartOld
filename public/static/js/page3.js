
var page3 = 1; //设置首页页码
var limit3 = 10;  //设置一页显示的条数
var total3;    //总条数

function loadData3(){
    $.ajax({
        type:"post",
        url:"/home/article/getNews?a_type=2&c_id="+$("#c_id").val(),//对应controller的URL
        async:false,
        dataType: 'json',
        data:{
            "pageIndex":page3,
            "pageSize":limit3,
        },
        success:function(ret3){
            total3=ret3.count;  //设置总条数
            var data3=ret3.data;
            var html3='';
            if(data3) {
                data3.forEach(function(value,index) {
                    html3+= '<li>';
                    html3+= '<a href="/home/article/details?a_id='+ value.a_id +'">'+ value.a_title + '<small>'+value.a_addtime + '</small></a></li>';
                });
            }
            $("#html3").empty().append(html3);
        }
    });
}
function getPage3(){
    layui.use('laypage', function(){
        var laypage = layui.laypage;
        //执行一个laypage实例
        laypage.render({
            elem: 'page3' //注意，这里的 test1 是 ID，不用加 # 号
            ,count: total3, //数据总数，从服务端得到
            limit:limit3,   //每页条数设置
            jump: function(obj, first){
                page3=obj.curr;  //改变当前页码
                limit3=obj.limit;
                //首次不执行
                if(!first){
                    loadData3()  //加载数据
                }
            }
        });
    });
}
