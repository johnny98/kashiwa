@extends('layout')

@section('content')

    <h1>詳細表示</h1>

    <div class="row">
        <div class="col-sm-12">
            <a href="/users" class="btn btn-primary" style="margin:20px;">一覧に戻る</a>
        </div>
    </div>

    <!-- table -->
    <table class="table table-striped">
        <tr><td>ID</td><td>{{$user->id}}</tr>
        <tr><td>名前</td><td>{{$user->name}}</tr>
        <tr><td>E-Mail</td><td>{{$user->email}}</tr>
        <tr><td>住所</td><td>{{$user->addr}}</tr>
        <tr><td>国籍</td><td>{{$country[$user->ctry]}}</tr>
    </table>

@stop