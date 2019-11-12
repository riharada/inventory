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
                            <input type="text" class="form-control" name="text" value="{{ $inventory->item->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="date">購入日</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="date" value="{{ $inventory->date }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $inventory->item_id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
               <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h3>購入履歴</h3>
                        <ul class="list-group">
                            @if ($inventory->item_id != NULL)
                                @foreach ($inventories as $inventory)
                                    <li class="list-group-item">{{ date('Y/m/d',  strtotime($inventory->date)) }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection