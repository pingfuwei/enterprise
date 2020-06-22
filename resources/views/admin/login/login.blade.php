<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>后台登录</title>
    <meta name="author" content="DeathGhost" />
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <style>
        body{height:100%;background:#16a085;overflow:hidden;}
        canvas{z-index:-1;position:absolute;}
    </style>
    <script src="/js/jquery.js"></script>
    <script src="/js/verificationNumbers.js"></script>
    <script src="/js/Particleground.js"></script>
    <script src="/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            //粒子背景特效
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
            //验证码
            createCode();
            //测试提交，对接程序删除即可
            $(".submit_btn").click(function(){
                location.href="index.html";
            });
        });
    </script>
</head>
<body>
<dl class="admin_login" id="app">
    <dt>
        <strong>中卫仲裁后台管理系统</strong>
        <em>Management System</em>
    </dt>
    <dd class="user_icon">
        <input type="text" placeholder="账号" v-model="names" class="login_txtbx"/>
    </dd>
    <dd class="pwd_icon">
        <input type="password" placeholder="密码" v-model="pas" class="login_txtbx"/>
    </dd>
    {{--<dd class="val_icon">--}}
        {{--<div class="checkcode">--}}
            {{--<input type="text" id="J_codetext" placeholder="验证码" maxlength="4" class="login_txtbx">--}}
            {{--<canvas class="J_codeimg" id="myCanvas" onclick="createCode()">对不起，您的浏览器不支持canvas，请下载最新版浏览器!</canvas>--}}
        {{--</div>--}}
        {{--<input type="button" value="验证码核验" class="ver_btn" onClick="validate();">--}}
    {{--</dd>--}}
    <dd>
        <input type="button" value="立即登陆" @click="send" class="submit_btn"/>
    </dd>
    <dd>
        <p>© 2015-2016 DeathGhost 版权所有</p>
        <p>陕B2-20080224-1</p>
    </dd>
</dl>
</body>
</html>
<script>
    var vm=new Vue({
        el:'#app',
        data:{
            names:null,
            pas:null
        },
        methods:{
            send:function () {
                var url="/admin/loginDo"
                var date={names:vm.names,pas:vm.pas}
                axios.post(url,date).then(function (res) {
                    alert(res.data.font)
                    if(res.data.code==000){
                        location.href=res.data.url
                    }
                })
            }
        }
    })
</script>
