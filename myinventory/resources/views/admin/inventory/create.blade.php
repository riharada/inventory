{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'商品の新規登録'を埋め込む --}}
@section('title','商品登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
 <div class="container">
   <div class="row">
     <div class="col-md-8 mx-auto">
       <h2>商品登録</h2>
       <form action="{{ action('Admin\InventoriesController@create') }}" method="post" enctype="multipart/form-data">
       
       @if (count($errors) > 0)
        <ul>
         @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
         @endforeach
        </ul>
       @endif
       
       <div class="form-group row">
        <label class="col-md-2" for="title">購入した商品</label>
      
       <select name="item_id">
        <option value=0 >選択してください</option>
        @foreach ($items as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
       
       @php
       echo "<br />";
       //これ入れても改行されない？
       @endphp
       
       
      </select>
      <div class="col-md-10">
      <h5>上記選択内になければ、以下に入力をお願いします↓</h5>
        <input type="text" class="form-control" name="input_item">
       </div>
      </div>　 　
     
     <div class="form-group row">
        <label class="col-md-2" for="date">購入日</label>
        <div class="col-md-10">
            <input type="date" class="form-control" name="date">
        </div>
    　</div>
      
      {{ csrf_field() }}
      <input type="submit" class="btn btn-primary" value="更新">
      
      </form>
     </div>
   </div>
 </div>
@endsection