<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class Product extends Model
{
    // use HasFactory;
    public function getList(Request $request) {

        $products = DB::table('products')
        ->join('companies','products.company_id','=','companies.id')
        ->select('products.*','companies.company_name as company_name');
        if($request->search) {
            $products->where('product_name', 'LIKE', "%{$request->search}%");
        }
        if($request->company_id) {
            $products->where("company_id",$request->company_id);
        }
        if($request->min_price){
            $products->where('price', '>=', $request->min_price);
        }
        if($request->max_price){
            $products->where('price', '<=', $request->max_price);
        }
        if($request->min_stock){
            $products->where('stock', '>=', $request->min_stock);
        }
        if($request->max_stock){
            $products->where('stock', '<=', $request->max_stock);
        }
        $products = $products->get();
 
        return $products;
    }

    public function getProduct($id) {
        $products = DB::table('products')
        ->join('companies','products.company_id','=','companies.id')
        ->select('products.*','companies.company_name as company_name')
        ->where('products.id', $id)
        ->get();

        return $products;
    }

    public function getEdit($id) {
        $products = DB::table('products')
        ->where('products.id', $id)
        ->get();

        return $products;
    }
    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function registProduct($data,$image_path) {
        DB::table('products')->insert([
            'company_id' => $data->company_id,
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $image_path,
        ]);
    }
    public function delProduct($id) {
        DB::table('products')->delete($id);
    }
    public function updateProduct($id, $data,$image_path) {
        DB::table('products')->where('id',$id)->update([
            'company_id' => $data->company_id,
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $image_path,
        ]);
    }   
}