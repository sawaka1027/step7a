@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品情報一覧</h1>
    <div class="products mt-5">
    <form action="{{ route('index') }}" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="検索キーワード" >
        <select class="form-select-sm" id="company_id" name="company_id">
            <option value="" selected>メーカー名</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach 
        </select>
        <button type="submit" class="btn btn-info btn-sm mx-1">検索</button>
    </form>
    </div>
    <div class="products mt-5">
        <h2>商品情報</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>メーカー</th>
                    <th><a href="{{ route('create') }}" class="btn btn-primary mb-1">商品新規登録</a></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id}}</td>
                    <td><img src="{{ asset($product->img_path) }}" width="100"></td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company_name }}</td>
                    <td>
                        <a href="{{ route('show', $product->id) }}" class="btn btn-info btn-sm mx-1">詳細</a>
                        <form method="POST" action="{{ route('destroy', $product->id) }}" class="d-inline">
                            @csrf
                                <button type="submit" class="btn btn-danger btn-sm mx-1" onclick='return confirm("本当に削除しますか？")'>削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>   
</div>
@endsection

