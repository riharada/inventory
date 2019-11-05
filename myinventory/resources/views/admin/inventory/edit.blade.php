@extends('layouts.admin')
@section('title', '在庫情報の編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>在庫情報編集</h2>
                <form action="{{ action('Admin\InventoryController@update') }}" method="post" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="title" value="{{ $inventory_form->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="number">在庫数（個）</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" name="number" value="{{ $inventory_form->number }}">                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="duration">消費日数（日）</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" name="duration">
                        </div>
                        </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $inventory_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection