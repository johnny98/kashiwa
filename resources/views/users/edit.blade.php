@extends('layout')

@section('content')

    <h1>情報編集</h1>

    <div class="row">
        <div class="col-sm-12">
            <a href="/users" class="btn btn-primary" style="margin:20px;">一覧に戻る</a>
        </div>
    </div>

    <!-- form -->
    <form method="post" action="/users/update/{{$user->id}}">

        <div class="form-group">
            <label>名前</label>
            <input type="text" name="name" value="{{$user->name}}" class="form-control">
        </div>

        <div class="form-group">
            <label>E-Mail</label>
            <input type="text" name="email" value="{{$user->email}}" class="form-control">
        </div>

        <div class="form-group">
            <label>住所</label>
            <input type="text" name="addr" value="{{$user->addr}}" class="form-control">
        </div>
        
        <div class="form-group">
            <label>国籍</label>
<select name="ctry">
  <option value="">--未選択--</option>
  <option value="ko">韓国</option>
  <option value="en">アメリカ合衆国</option>
  <option value="ja">日本</option>
  <option value="ch">中国</option>
  <option value="ma">マレーシア</option>
</select>        </div>


        <input type="hidden" name="_token" value="{{csrf_token()}}">

        <input type="submit" value="更新" class="btn btn-primary">

    </form>

@stop