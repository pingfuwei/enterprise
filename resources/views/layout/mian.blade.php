<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>中卫仲裁后台管理系统</title>
    <meta name="author" content="DeathGhost" />
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <!--[if lt IE 9]>
    <script src="/js/html5.js"></script>
    <![endif]-->
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        (function($){
            $(window).load(function(){

                $("a[rel='load-content']").click(function(e){
                    e.preventDefault();
                    var url=$(this).attr("href");
                    $.get(url,function(data){
                        $(".content .mCSB_container").append(data); //load new content inside .mCSB_container
                        //scroll-to appended content
                        $(".content").mCustomScrollbar("scrollTo","h2:last");
                    });
                });

                $(".content").delegate("a[href='top']","click",function(e){
                    e.preventDefault();
                    $(".content").mCustomScrollbar("scrollTo",$(this).attr("href"));
                });

            });
        })(jQuery);
    </script>
</head>
<body>
<!--header-->
<header>
    <h1><img src="/images/admin_logo.png"/></h1>
    <ul class="rt_nav">
        <li><a href="http://www.baidu.com" target="_blank" class="website_icon">站点首页</a></li>
        <li><a href="#" class="admin_icon" style="color:gold">{{session("user")}}</a></li>
        <li><a href="#" class="set_icon">账号设置</a></li>
        <li><a href="" class="quit_icon">安全退出</a></li>
        {{--{{url('admin/out')}}--}}
    </ul>
</header>

<!--aside nav-->
<aside class="lt_aside_nav content mCustomScrollbar">
    <h2><a href="index.php">起始页</a></h2>
    <ul>
        <li>
            <dl>
                <dt>商品信息</dt>
                <!--当前链接则添加class:active-->
                @if(request()->route()->getAction()["uses"]=="App\Http\Controllers\admin\IndexController@index")
                    <dd><a href="{{url('admin/index')}}" class="active">项目开发后台</a></dd>
                @else
                    <dd><a href="{{url('admin/index')}}" >项目开发后台</a></dd>
                @endif
                @if(request()->route()->getAction()["uses"]=="App\Http\Controllers\admin\AdminController@create")
                    <dd><a class="active" href="{{url('admin/admin/create')}}">管理员</a></dd>
                @else
                   <dd><a href="{{url('admin/admin/create')}}">管理员模块</a></dd>
                @endif
                @if(request()->route()->getAction()["uses"]=="App\Http\Controllers\admin\NavigationController@create")
                    <dd><a class="active" href="{{url('admin/Navigation/create')}}">导航操作</a></dd>
                @else
                    <dd><a href="{{url('admin/Navigation/create')}}">导航操作</a></dd>
                @endif
                {{--@if(request()->route()->getAction()["uses"]=="App\Http\Controllers\admin\NavigationController@create")--}}
                    {{--<dd><a class="active" href="{{url('admin/Navigation/create')}}">分类</a></dd>--}}
                {{--@else--}}
                    {{--<dd><a href="{{url('admin/Navigation/create')}}">分类</a></dd>--}}
                {{--@endif--}}
            </dl>
        </li>
    </ul>
</aside>

<section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">

        <section>
            @yield('content')
        </section>




    </div>
</section>
</body>
<script>
    $(function () {
        $(document).on("click",".quit_icon",function () {
            if(confirm("确定退出嘛")){
                $(this).prop("href","out")
            }else{
                $(this).prop("href","javascript:;")
            }
        })
    })
</script>
</html>
