@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-4">商品情報一覧</h1>
        <div class="products mt-5">
            <form id="product-form" action="{{ route('index') }}" method="GET">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="検索キーワード">
                <select class="form-select-sm" id="company_id" name="company_id">
                    <option value="" selected>メーカー名</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
                <input type="number" name="min_price" placeholder="最小価格" value="{{ request('min_price') }}">
                <input type="number" name="max_price" placeholder="最大価格" value="{{ request('max_price') }}">
                <input type="number" name="min_stock" placeholder="最小在庫" value="{{ request('min_stock') }}">
                <input type="number" name="max_stock" placeholder="最大在庫" value="{{ request('max_stock') }}">
                <button type="submit" class="btn btn-info btn-sm mx-1">検索</button>
            </form>
        </div>
        <!-- 検索条件をリセットするためのリンクボタン -->
        <a href="{{ route('index') }}" class="btn btn-success mt-3">検索条件を元に戻す</a>

        <div class="products mt-5" id="result-area">
            <h2>商品情報</h2>
            <table id="myTable" class="tablesorter">
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
                            <td>{{ $product->id }}</td>
                            <td><img src="{{ asset($product->img_path) }}" width="100"></td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->company_name }}</td>
                            <td>
                                <a href="{{ route('show', $product->id) }}" class="btn btn-info btn-sm mx-1">詳細</a>
                                <form method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm mx-1 delete-btn">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#product-form').on('submit', function(event) {
                event.preventDefault();

                let formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('index') }}",
                    type: 'GET',
                    data: formData,
                    success: function(data) {
                        let html = '';
                        data.forEach(product => {
                            html += `
                            <tr>
                                <td>${product.id}</td>
                                <td><img src="${product.img_path}" width="100"></td>
                                <td>${product.product_name}</td>
                                <td>${product.price}</td>
                                <td>${product.stock}</td>
                                <td>${product.company_name}</td>
                                <td>
                                    <a href="{{ route('show', $product->id) }}" class="btn btn-info btn-sm mx-1">詳細</a>
                                    <form method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm mx-1 delete-btn">削除</button>
                                    </form>
                                </td>
                            </tr>`;
                        });
                        $('#result-area').html(`
                        <table id="myTable" class="tablesorter">
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
                                ${html}
                            </tbody>
                        </table>
                    `);

                        // テーブルソートを適用
                        $("#myTable").tablesorter();
                    },
                    error: function() {
                        $('#response-message').text('エラーが発生しました。');
                    }
                });
            });

            // 初回ページ読み込み時のテーブルソート設定
            $("#myTable").tablesorter();
        });

        $(document).on('click', '.delete-btn', function(event) {
            event.preventDefault();

            if (confirm('本当に削除しますか？')) {
                const row = $(this).closest('tr'); // ボタンが属する行を取得
                $.ajax({
                    url: "{{ route('destroy', $product->id) }}",
                    type: 'POST',
                    success: function(response) {
                        row.remove(); // 削除した行を画面上から非表示にする
                    },
                    error: function(xhr) {
                        alert('削除処理でエラーが発生しました。');
                    }
                });
            }
        });
    </script>
@endsection
