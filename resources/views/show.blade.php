@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品情報詳細</h1>
    @foreach ($products as $product)
    <dl class="row mt-3" >
        <dt class="col-sm-3">商品情報ID</dt>
        <dd class="col-sm-9">{{ $product->id }}</dd>
        <dt class="col-sm-3">商品画像</dt>
        <dd class="col-sm-9"><img src="{{ asset($product->img_path) }}" width="200"></dd>
        <dt class="col-sm-3">商品名</dt>
        <dd class="col-sm-9">{{ $product->product_name }}</dd>
        <dt class="col-sm-3">メーカー</dt>
        <dd class="col-sm-9">{{ $product->company_name }}</dd>
        <dt class="col-sm-3">価格</dt>
        <dd class="col-sm-9">{{ $product->price }}</dd>
        <dt class="col-sm-3">在庫数</dt>
        <dd class="col-sm-9">{{ $product->stock }}</dd>
        <dt class="col-sm-3">コメント</dt>
        <dd class="col-sm-9">{{ $product->comment }}</dd>
    </dl>
    @endforeach
    <div class="form-group">
        <a href="{{ route('edit',$product->id) }}" class="btn btn-primary">編集</a>
        <a href="{{ route('index') }}" class="btn btn-secondary">戻る</a>
    </div>
</div>
@endsection

