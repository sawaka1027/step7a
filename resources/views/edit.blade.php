@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品情報編集</h1>
    @foreach ($products as $product)
        <form action="{{ route('update', $product->id) }}"method="post" enctype="multipart/form-data">
            @csrf
            <dl class="row mt-3">
                <dt class="col-sm-3">商品情報ID</dt>
                <dd class="col-sm-9">{{ $product->id }}</dd>

                <dt class="col-sm-3">商品名<span class="text-danger">*</span></dt>
                <dd class="col-sm-9">
                    <input type="text" class="form-control" id="product_name" name="product_name"
                        value="{{ $product->product_name }}">
                    @if ($errors->has('product_name'))
                        <p class="text-danger">{{ $errors->first('product_name') }}</p>
                    @endif
                </dd>
                <dt class="col-sm-3">メーカー名<span class="text-danger">*</span></dt>
                <dd class="col-sm-9">
                    <select class="form-select" id="company_id" name="company_id">
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}"
                                {{ $product->company_id == $company->id ? 'selected' : '' }}>
                                {{ $company->company_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('company_id'))
                        <p class="text-danger">{{ $errors->first('company_id') }}</p>
                    @endif
                </dd>
                <dt class="col-sm-3">価格<span class="text-danger">*</span></dt>
                <dd class="col-sm-9">
                    <input type="text" class="form-control" id="price" name="price"
                        value="{{ $product->price }}">
                    @if ($errors->has('price'))
                        <p class="text-danger">{{ $errors->first('price') }}</p>
                    @endif
                </dd>
                <dt class="col-sm-3">在庫数<span class="text-danger">*</span></dt>
                <dd class="col-sm-9">
                    <input type="text" class="form-control" id="stock" name="stock"
                        value="{{ $product->stock }}">
                    @if ($errors->has('stock'))
                        <p class="text-danger">{{ $errors->first('stock') }}</p>
                    @endif
                </dd>
                <dt class="col-sm-3">コメント</dt>
                <dd class="col-sm-9">
                    <textarea class="form-control" id="comment" name="comment">{{ $product->comment }}</textarea>
                    @if ($errors->has('comment'))
                        <p class="text-danger">{{ $errors->first('comment') }}</p>
                    @endif
                </dd>
                <dt class="col-sm-3">商品画像</dt>
                <dd class="col-sm-9">
                    <input id="img_path" type="file" name="img_path" value="{{ $product->img_path }}">
                </dd>
            </dl>
            <button type="submit" class="btn btn-primary">更新</button>
            <a href="{{ route('show', $product->id) }}" class="btn btn-secondary">戻る</a>
        </form>
    @endforeach
</div>
@endsection

