{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'商品の新規登録'を埋め込む --}}
@section('title','商品の新規登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
 <div class="container">
   <div class="row">
     <div class="col-md-8 mx-auto">
       <h2>商品新規登録</h2>
       <form action="{{ action('Admin\InventoryController@create') }}" method="post" enctype="multipart/form-data">
       
       @if (count($errors) > 0)
        <ul>
         @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
         @endforeach
        </ul>
       @endif
       <div class="form-group row">
        <label class="col-md-2" for="title">商品名</label>
       <div class="col-md-10">
        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
       </div>
      </div>
      <div class="form-group row">
       <label class="col-md-2" for="number">個数（個）</label>
       <div class="col-md-10">
        <input type="number" class="form-control" name="number" value="{{ old('number') }}">
       </div>
      </div>
      <div class="form-group row">
       <label class="col-md-2" for="date">使用開始日</label>
       <div class="col-md-10">
        <input type="date" class="form-control" name="date" value="{{ old('date') }}">
       </div>
      </div>
      <div class="form-group row">
       <label class="col-md-2" for="duration">消費日数（日）</label>
       <div class="col-md-10">
        <input type="number" class="form-control" name="duration" value="{{ old('duration') }}">
       </div>
      </div>
      {{ csrf_field() }}
      <input type="submit" class="btn btn-primary" value="更新">
       </form>
     </div>
   </div>
 </div>
@endsection