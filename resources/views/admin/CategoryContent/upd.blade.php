
@extends('layout.mian')
@section('content')
    <center>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <table class="table">
            <h1 style="margin-right: 950px;" class="link_btn">普通分类内容修改</h1><h1 style="float: right" class="link_btn"><a href="/admin/CategoryContent/index" style="color: #ffffff">点击展示</a></h1>
            <ul class="ulColumn2">

                <li>
                    <div>
                    <h1><span class="item_name" style="color: red">{{$info->title_name}}：</span></h1>
                    </div>
                    {{--<span class="errorTips">错误提示信息...</span>--}}
                    <textarea name="" class="textbox textbox_295" style="width: 1000px;height: 410px;" id="content" cols="300" rows="100">{{$info->content}}</textarea>
                </li>


                <li style="float: left">
                    <span class="item_name" style="width:120px;"></span>
                    <input type="button" class="link_btn" id="send" value="修改分类"/>
                </li>
            </ul>
        </table>
    </center>
@endsection