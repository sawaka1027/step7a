<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;
    public function getComList(){
        $companies = DB::table('companies')
        ->get();
        return $companies;
    }
    public function products()
    {
    return $this->hasMany(Product::class);
    }
}
