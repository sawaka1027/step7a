<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\PruductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getList(Request $request)
    {
        $model = new Product();
        $products = $model->getList($request->search,$request->company_id);
        $model = new Company();
        $companies = $model->getComList();
        return view('index', ['products' => $products],['companies' => $companies]);
    }
 
    public function show($id)
    {
        $model = new Product();
        $products = $model->getProduct($id);

        return view('show', ['products' => $products]);
    }
    public function edit($id)
    {
        $model = new Product();
        $products = $model->getEdit($id);
        $model = new Company();
        $companies = $model->getComList();
        return view('edit', ['products' => $products],['companies' => $companies]);
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $model = new Product();
            $model->delProduct($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back();
        }
        return redirect('index');
    }
    public function create()
    {
        $model = new Company();
        $companies = $model->getComList();
        return view('create', ['companies' => $companies]);
    }
    public function store(PruductRequest $request)
    {
        DB::beginTransaction();
        $image_path=null;
        try {
            if($request->hasFile('img_path')){ 
                $image = $request->file('img_path');
                $filename=$image->getClientOriginalName();
                $image -> storeAs('public/images', $filename);
                $image_path = 'storage/images/' . $filename;
            }
            $model = new Product();
            $model->registProduct($request,$image_path);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back();
        }
        return redirect(route('index'));
    }

    public function update($id,PruductRequest $request)
    {
        DB::beginTransaction();
        $image_path=null;
        try {
            if($request->hasFile('img_path')){ 
                $image = $request->file('img_path');
                $filename=$image->getClientOriginalName();
                $image -> storeAs('public/images', $filename);
                $image_path = 'storage/images/' . $filename;
            }
            $model = new Product();
            $model->updateProduct($id,$request,$image_path);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back();
        }
        return redirect(route('edit',$id));
    }

}
