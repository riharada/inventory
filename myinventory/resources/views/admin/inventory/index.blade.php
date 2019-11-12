@extends('layouts.admin')

@section('title', '登録済み在庫一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>在庫一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\InventoriesController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\InventoriesController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">商品名</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-inventory col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="10%">商品名</th>
                                <th width="10%">直近購入日</th>
                                <th width="10%">消費日数</th>
                                <th width="10%">次回購入まで</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventories as $inventory)
                            <tr>
                                    <th>{{ $inventory->item->id }}</th>
                                    <td>{{ \Str::limit($inventory->item->name, 50) }}</td>
                                    <th>{{ date('Y年m月d日',  strtotime($inventory->date)) }}</th>
                                    
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\InventoriesController@edit', ['id' => $inventory->id]) }}">更新</a>
                                        </div>
                                        <div>
                                            <a href="{{ action('Admin\InventoriesController@delete',['id' => $inventory->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      <div class="d-flex justify-content-center">
         {{ $pages->links() }}
      </div>
      </div>
@endsection