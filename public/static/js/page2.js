
var page2 = 1; //设置首页页码
var limit2 = 10;  //设置一页显示的条数
var total2;    //总条数

function loadData2(){
    $.ajax({
        type:"post",
        url:"/home/article/getNews?a_type=1&c_id="+$("#c_id").val(),//对应controller的URL
        async:false,
        dataType: 'json',
        data:{
            "pageIndex":page2,
            "pageSize":limit2,
        },
        success:function(ret2){
            total2=ret2.count;  //设置总条数
            var data2=ret2.data;
            var html2='';
            if(data2) {
                data2.forEach(function (value, index) {
                    html2 += '<li>';
                    html2 += '<a href="/home/article/details?a_id=' + value.a_id + '">' + value.a_title + '<small>' + value.a_addtime + '</small></a></li>';
                });
            }
            $("#html2").empty().append(html2);
        }
    });
}
function getPage2(){
    layui.use('laypage', function(){
        var laypage = layui.laypage;
        //执行一个laypage实例
        laypage.render({
            elem: 'page2' //注意，这里的 test1 是 ID，不用加 # 号
            ,count: total2, //数据总数，从服务端得到
            limit:limit2,   //每页条数设置
            jump: function(obj, first){
                page2=obj.curr;  //改变当前页码
                limit2=obj.limit;
                //首次不执行
                if(!first){
                    loadData2()  //加载数据
                }
            }
        });
    });
}
