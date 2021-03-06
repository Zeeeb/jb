<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('admin/laydate/laydate.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/index.js')}}"></script>
    <script language="javascript" src="{{asset('js/city.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/pagination.css')}}"/>
    <script type="text/javascript" src="{{asset('js/pagination.min.js')}}"></script>
    <script language="javascript">
        function gotopage()
        {
            page=document.getElementById("page").value;
            var url="{{URL('jb_admin/kehu/'.$do)}}?id={{$id}}&title={{$title}}&name={{$name}}&phone={{$phone}}&dizhi={{$dizhi}}&page="+page;
            if(page=="")
            {
                alert("请输入页数！");
            }
            else
            {
                window.location.href=url;
            }

        }
        function queren(msg)
        {
            if(!confirm(msg))
            {
                window.event.returnValue = false;
            }
        }
        function loadData(currPage, pageSize) {
            var id=$("#p_id").val();
            var title=$("#p_title").val();
            var phone=$("#p_phone").val();
            var name=$("#p_name").val();
            var dizhi=$("#p_dizhi").val();
            $.ajax({
                type: "POST",
                url: "/jb_admin/kehu/kehulist",
                data: {"currPage":currPage,"pageSize":pageSize,"id":id,"title":title,"phone":phone,"name":name,"dizhi":dizhi},
                datatype: "json",
                async:false,
                beforeSend: function () {
                    $('#kehulist').html('加载中');
                },
                success: function(res){
                    var str="";
                    str+="<table width=\"100%\" style=\"text-align:center;background-color:#fff; margin-top:30px; line-height:30px;\" cellpadding=\"0\" cellspacing=\"0\">";
                    str+="<tr class=\"tr\"><td >客户编号</td><td >客户名称</td><td>联系人</td><td>电话</td><td>联系地址</td><td>备注</td><td>添加时间</td><td>操作</td></tr>";
                    for(var i in res.content){
                        str+="<tr><td>"+res.content[i].id+"</td><td>"+res.content[i].title+"</td><td>"+res.content[i].name+"</td><td>"+res.content[i].phone+"</td>";
                        str+="<td>"+res.content[i].dizhi+"</td><td>"+res.content[i].beizhu+"</td><td>"+res.content[i].shijian+"</td>";

                        str+="<td><a href='{{URL('jb_admin/kehu/info')}}/"+res.content[i].id+"'>修改</a> | <a onclick=\"queren('确定要删除吗?')\" href='{{URL('jb_admin/excsql/delkehu')}}/"+res.content[i].id+"'>删除</a> </td></tr>";
                    }
                    str+="</table>";
                    $('#kehulist').html(str);
                    $("#pagination").whjPaging("setPage", res.currPage, res.totalPage);

                },
                error: function(response){
                    alert('数据解析异常！');
                }
            });
        }


    </script>
</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<div id="main">
    <div class="user">
        @if($do=='list')
        <div class="title"><span></span>客户搜索</div>
        <div class="user-search">
            <form name="form1" class="myform" method="get" action="{{URL('jb_admin/kehu/list')}}">
                &nbsp;
                客户编号：<input type="text" name="p_id" id="p_id" class="text" value="{{$id}}" />
                客户名称：<input type="text" name="title"  id="p_title" class="text" value="{{$title}}" />
                联系人：<input type="text" name="name"  id="p_name" class="text" value="{{$name}}" />
                联系方式：<input type="text" name="phone"  id="p_phone" class="text" value="{{$phone}}" />
                联系地址：<input type="text" name="dizhi"  id="p_dizhi" class="text" value="{{$dizhi}}" />
                <input type="button" value="查找" class="button" onclick="loadData(1,10)" /> <a href="{{URL('jb_admin/kehu/list')}}">清楚搜索条件</a>
            </form>
        </div>
        <div class="user-list">
            <div id="kehulist">加载中</div>
            <div id="pagination" style="padding: 30px 10px; float: left;"></div>
            <script language="JavaScript">
                //设置分页插件显示
                $("#pagination").whjPaging({
                    //可选，每页显示条数下拉框，默认下拉框5条/页(默认)、10条/页、15条/页、20条/页
                    pageSizeOpt: [
                        {'value': 10, 'text': '10条/页', 'selected': true},
                        {'value': 20, 'text': '20条/页'},
                        {'value': 50, 'text': '50条/页'},
                        {'value': 100, 'text': '100条/页'}
                    ],
                    //可选，css设置，可设置值：css-1，css-2，css-3，css-4，css-5，默认css-1，可自定义样式
                    css: 'css-5',
                    //可选，总页数
                    totalPage:{{$totelpage}},
                    //可选，展示页码数量，默认5个页码数量
                    showPageNum: 8,
                    //可选，首页按钮展示文本，默认显示文本为首页
                    firstPage: '首页',
                    //可选，上一页按钮展示文本，默认显示文本为上一页
                    previousPage: '上一页',
                    //可选，下一页按钮展示文本，默认显示文本为下一页
                    nextPage: '下一页',
                    //可选，尾页按钮展示文本，默认显示文本为尾页
                    lastPage: '尾页',
                    //可选，跳至展示文本，默认显示文本为跳至
                    skip: '跳至',
                    //可选，确认按钮展示文本，默认显示文本为确认
                    confirm: '确认',
                    //可选，刷新按钮展示文本，默认显示文本为刷新
                    refresh: '刷新',
                    //可选，共{}页展示文本，默认显示文本为共{}页，其中{}会在js具体转化为数字
                    totalPageText: '共{}页',
                    //可选，是否展示首页与尾页，默认true
                    isShowFL: true,
                    //可选，是否展示每页N条下拉框，默认true
                    isShowPageSizeOpt: true,
                    //可选，是否展示跳到指定页数，默认true
                    isShowSkip: true,
                    //可选，是否展示刷新，默认true
                    isShowRefresh: true,
                    //可选，是否展示共{}页，默认true
                    isShowTotalPage: true,
                    //可选，是否需要重新设置当前页码及总页数，默认false，如果设为true，那么在请求服务器返回数据时，需要调用setPage方法
                    isResetPage: false,
                    //必选，回掉函数，返回参数：第一个参数为页码，第二个参数为每页显示N条
                    callBack: function (currPage, pageSize) {
                        loadData(currPage, pageSize);
                    }
                });
                loadData(1,10);
            </script>
        </div>
        @elseif($do=='info')
            <div class="title"><span></span>编辑客户资料</div>
            <div class="user-search">
                <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/editkehu/'.$data[0]->id)}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <table width="855" style="margin-top: 100px;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" width="400">客户编号：</td>
                            <td><input type="text" class="input" name="id" value="{{$data[0]->id}}" readonly /><font color="#f00">* 不可编辑</font></td>
                        </tr>
                        <tr>
                            <td align="right">客户名称:</td>
                            <td><input type="text" class="input" name="title" value="{{$data[0]->title}}" nullmsg="请输入客户名称！" datatype="*"></td>
                        </tr>
                        <tr>
                            <td align="right">联系人：</td>
                            <td><input type="text" class="input" name="name" value="{{$data[0]->name}}" nullmsg="请输入联系人！" datatype="*" /></td>
                        </tr>
                        <tr>
                            <td align="right">联系电话：</td>
                            <td><input type="text" class="input" name="phone" value="{{$data[0]->phone}}"  nullmsg="请输入联系电话！" datatype="*" /></td>
                        </tr>
                        <tr>
                            <td align="right">地址：</td>
                            <td><input type="text" class="input" name="dizhi" value="{{$data[0]->dizhi}}" nullmsg="请输入地址！" datatype="*" /></td>
                        </tr>
                        <tr>
                            <td align="right">备注：</td>
                            <td><textarea name="beizhu" style="width: 300px; height: 100px;">{{$data[0]->beizhu}}</textarea></td>
                        </tr>
                        <tr>
                            <td align="right">创建时间：</td>
                            <td>{{date('Y-m-d H:i:s',$data[0]->shijian)}}</td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td><input type="submit" value="更新客户资料" style="width:100px; height:40px; line-height:40px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;"  /></td>
                        </tr>
                    </table>
                    <br /> <br /> <br /> <br />
                </form>
            </div>
            <div class="user-list">
            </div>

        @elseif($do=='add')
        <div class="title"><span></span>新增客户</div>
        <div class="user-search">
            <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/addkehu')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <table width="855" style="margin-top: 100px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="right" width="400">客户编号：</td>
                        <td><input type="text" class="input" name="id" value="{{$id}}" readonly />系统生成，仅供参考</td>
                    </tr>
                    <tr>
                        <td align="right">客户名称:</td>
                        <td><input type="text" class="input" name="title" value="" nullmsg="请输入客户名称！" datatype="*" ajaxurl="{{URL('checkkehu')}}"></td>
                    </tr>
                    <tr>
                        <td align="right">联系人：</td>
                        <td><input type="text" class="input" name="name" value="" nullmsg="请输入联系人！" datatype="*" /></td>
                    </tr>
                    <tr>
                        <td align="right">联系电话：</td>
                        <td><input type="text" class="input" name="phone" value=""  nullmsg="请输入联系电话！" datatype="*" /></td>
                    </tr>
                    <tr>
                        <td align="right">地址：</td>
                        <td><input type="text" class="input" name="dizhi" value="" nullmsg="请输入地址！" datatype="*" /></td>
                    </tr>
                    <tr>
                        <td align="right">备注：</td>
                        <td><textarea name="beizhu" style="width: 300px; height: 100px;"></textarea></td>
                    </tr>

                    <tr>
                        <td align="right"></td>
                        <td><input type="submit" value="添加客户" style="width:100px; height:40px; line-height:40px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;"  /></td>
                    </tr>
                </table>
                <br /> <br /> <br /> <br />
            </form>
        </div>
        <div class="user-list">
        </div>
        @endif
    </div>
</div>
<script language="javascript" src="{{asset('admin/js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $(".myform").Validform({
            tiptype:3,
            datatype:{
                "idcard":function(gets,obj,curform,datatype){
                    var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子;
                    var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值，10代表X;

                    if (gets.length == 15) {
                        return isValidityBrithBy15IdCard(gets);
                    }else if (gets.length == 18){
                        var a_idCard = gets.split("");// 得到身份证数组
                        if (isValidityBrithBy18IdCard(gets)&&isTrueValidateCodeBy18IdCard(a_idCard)) {
                            return true;
                        }
                        return false;
                    }
                    return false;

                    function isTrueValidateCodeBy18IdCard(a_idCard) {
                        var sum = 0; // 声明加权求和变量
                        if (a_idCard[17].toLowerCase() == 'x') {
                            a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作
                        }
                        for ( var i = 0; i < 17; i++) {
                            sum += Wi[i] * a_idCard[i];// 加权求和
                        }
                        valCodePosition = sum % 11;// 得到验证码所位置
                        if (a_idCard[17] == ValideCode[valCodePosition]) {
                            return true;
                        }
                        return false;
                    }

                    function isValidityBrithBy18IdCard(idCard18){
                        var year = idCard18.substring(6,10);
                        var month = idCard18.substring(10,12);
                        var day = idCard18.substring(12,14);
                        var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));
                        // 这里用getFullYear()获取年份，避免千年虫问题
                        if(temp_date.getFullYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){
                            return false;
                        }
                        return true;
                    }

                    function isValidityBrithBy15IdCard(idCard15){
                        var year =  idCard15.substring(6,8);
                        var month = idCard15.substring(8,10);
                        var day = idCard15.substring(10,12);
                        var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));
                        // 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法
                        if(temp_date.getYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){
                            return false;
                        }
                        return true;
                    }

                }

            }
        });
    })
</script>
</body>
</html>
