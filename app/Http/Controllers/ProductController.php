<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\PruductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getList()
    {
        $model = new Product();
        $products = $model->getList();

        return view('index', ['products' => $products]);
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
        try {
            $model = new Product();
            $model->registProduct($request);
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
        try {
            $model = new Product();
            $model->updateProduct($id,$request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back();
        }
        return redirect(route('edit',$id));
    }
}
