<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        // 入力データの検証
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // 商品情報を取得
        $product = Product::find($validatedData['product_id']);

        // 在庫チェック
        if ($product->stock < $validatedData['quantity']) {
            return response()->json(['error' => '在庫が不足しています。'], 400);
        }

        // トランザクション処理
        \DB::transaction(function () use ($product, $validatedData) {
            // salesテーブルにレコードを追加
            Sale::create([
                'product_id' => $product->id,
                'quantity' => $validatedData['quantity']
            ]);

            // 在庫数を減算
            $product->stock -= $validatedData['quantity'];
            $product->save();
        });

        return response()->json(['success' => '購入が完了しました。']);
    }
}