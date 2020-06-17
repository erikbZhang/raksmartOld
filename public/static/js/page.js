window.onload= function () {
    loadData()  //请求数据
    getPage()     //分页操作

    loadData2()  //请求数据
    getPage2()     //分页操作

    loadData3()  //请求数据
    getPage3()     //分页操作

}
var page = 1; //设置首页页码
var limit = 10;  //设置一页显示的条数
var total;    //总条数

function loadData(){
    $.ajax({
        type:"post",
        url:"/home/article/getNews?c_id="+$("#c_id").val(),//对应controller的URL
        async:false,
        dataType: 'json',
        data:{
            "pageIndex":page,
            "pageSize":limit,
        },
        success:function(ret){
            total=ret.count;  //设置总条数
            var data1=ret.data;
            var html='';
            if(data1){
                data1.forEach(function(value,index) {
                    html+= '<li>';
                    html+= '<a href="/home/article/details?a_id='+ value.a_id +'">'+ value.a_title + '<small>'+value.a_addtime + '</small></a></li>';
                });
            }
            $("#html1").empty().append(html);
        }
    });
}
function getPage(){
    layui.use('laypage', function(){
        var laypage = layui.laypage;
        //执行一个laypage实例
        laypage.render({
            elem: 'page1' //注意，这里的 test1 是 ID，不用加 # 号
            ,count: total, //数据总数，从服务端得到
            limit:limit,   //每页条数设置
            jump: function(obj, first){
                page=obj.curr;  //改变当前页码
                limit=obj.limit;
                //首次不执行
                if(!first){
                    loadData()  //加载数据
                }
            }
        });
    });
}
