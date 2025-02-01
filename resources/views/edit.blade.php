@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品情報編集</h1>
    @foreach ($products as $product)
    <form action="{{ route('update',$product->id) }}"method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="product_name">商品名:<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}">
            @if($errors->has('product_name'))
                <p class="text-danger">{{ $errors->first('product_name') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="company_id">メーカー:<span class="text-danger">*</span></label>
            <select class="form-select" id="company_id" name="company_id">
                @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ $product->company_id == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                @endforeach 
            </select>
            @if($errors->has('company_id'))
                <p class="text-danger">{{ $errors->first('company_id') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="price">価格:<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">
            @if($errors->has('price'))
                <p class="text-danger">{{ $errors->first('price') }}</p>
            @endif
        </div>        
        <div class="form-group">
            <label for="stock">在庫数:<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="stock" name="stock" value="{{ $product->stock }}">
            @if($errors->has('stock'))
                <p class="text-danger">{{ $errors->first('stock') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea class="form-control" id="comment" name="comment">{{ $product->comment }}</textarea>
            @if($errors->has('comment'))
                <p class="text-danger">{{ $errors->first('comment') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="img_path" class="form-label">商品画像:</label>
            <input id="img_path" type="file" name="img_path" class="form-control">
        </div>
        @endforeach
    <div class="form-group">
        <button type="submit" class="btn btn-primary">保存</button>
        <a href="{{ route('show',$product->id) }}" class="btn btn-secondary">戻る</a>
    </div>
    </form>
</div>
@endsection

