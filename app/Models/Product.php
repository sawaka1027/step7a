<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    // use HasFactory;
    public function getList($search,$company_id) {

        $products = DB::table('products')
        ->join('companies','products.company_id','=','companies.id')
        ->select('products.*','companies.company_name as company_name');
        if($search) {
            $products->where('product_name', 'LIKE', "%{$search}%");
        }
        if($company_id) {
            $products->where("company_id",$company_id);
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