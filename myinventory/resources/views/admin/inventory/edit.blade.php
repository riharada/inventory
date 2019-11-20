@extends('layouts.admin')
@section('title', 'ニュースの編集')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2>商品編集</h2>
        <form action="{{ action('Admin\InventoriesController@update') }}" method="post" enctype="multipart/form-data">
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                  <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          <div class="form-group row">
            <label class="col-md-2" for="input_item">商品名</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="text" value="{{ $item->name }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="date">購入日</label>
            <div class="col-md-10">
              <input type="date" class="form-control" name="date" value=#>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-2 offset-md-10">
              <input type="hidden" name="id" value="{{ $item->id }}">
              {{ csrf_field() }}
              <input type="submit" class="btn btn-primary" value="更新">
            </div>
          </div>
        </form>
        <form action="{{ action('Admin\ItemsController@delete') }}" enctype="multipart/form-data">
          <div class="form-group row">
            <div class="col-md-2 offset-md-10">
              <input type="hidden" name="id" value="{{ $item->id }}">
              <input type="submit" class="btn btn-danger" value="削除">
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row mt-5">
      <table class="table col-md-4 offset-md-4">
      <h3>購入履歴</h3>
        <tbody class="thread-light">
          
            @if ($item->inventories != NULL)
              @foreach ($item->inventories as $inventory)
              <tr>
                <td>{{ date('Y/m/d',  strtotime($inventory->date)) }}</td>
          　 　   <form action="{{ action('Admin\InventoriesController@delete') }}" method="get">
	                <input type="hidden" name="id" value="{{ $inventory->id }}">
                  <td><input type="submit" class="btn btn-link" value="×"></td>
                </form>
              </tr>
              @endforeach
            @endif
        </tbody>
      </table>
    </div>
  </div>
@endsection