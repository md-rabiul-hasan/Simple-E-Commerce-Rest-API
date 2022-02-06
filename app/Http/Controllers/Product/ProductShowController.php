<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductShowController extends Controller
{
    public function index(){
        try{
            $products = Product::select(['id','name','description','price','qty','images','entry_date'])->get();
            return $this->successApiResponse(200, 'Product List', $products);
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        } 
    }

    public function search($product_name){
        try{
            $products = Product::select(['id','name','description','price','qty','images','entry_date'])->where('name','LIKE','%'.$product_name.'%')->get();
            return $this->successApiResponse(200, 'Product Searching Result', $products);
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        }         
    }

    public function highestToLowest(){
        try{
            $products = Product::select(['id','name','description','price','qty','images','entry_date'])->orderBy('price', 'desc')->get();
            return $this->successApiResponse(200, 'Product Sorting Success', $products);
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        } 
    }

    public function lowestToHighest(){
        try{
            $products = Product::select(['id','name','description','price','qty','images','entry_date'])->orderBy('price', 'asc')->get();
            return $this->successApiResponse(200, 'Product Sorting Success', $products);
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        } 
    }

}
