@extends('layouts.admin')
@extends('layouts.pagenation')

@section('title', '登録済み在庫一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>在庫一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\InventoryController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\InventoryController@index') }}" method="get">
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
                                <th width="10%">在庫数（個）</th>
                                <th width="10%">使用開始日</th>
                                <th width="10%">消費日数（日）</th>
                                <th width="10%">使用終了まで</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventories as $inventory)
                                <tr>
                                    <th>{{ $inventory->id }}</th>
                                    <td>{{ \Str::limit($inventory->title, 50) }}</td>
                                    <th>{{ $inventory->number }}</th>
                                    <th>{{ $inventory->date }}</th>
                                    <th>{{ $inventory->duration }}</th>
                                    <th>
                                        @php
                                            $dt2 = $inventory->date;
                                            $dt3 = $dt2->addDay($inventory->duration);
                                            echo $diff = $now->diff($dt3)->format('あと %d 日');
                                        @endphp
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection