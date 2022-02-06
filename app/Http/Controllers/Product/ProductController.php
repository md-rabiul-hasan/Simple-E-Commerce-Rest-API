<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductEditRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(ProductStoreRequest $request){
        //store file into document folder
        $images = $request->file('images')->store('product', 'public');
        $product              = new Product();
        $product->name        = $request->input('name');
        $product->description = $request->input('description');
        $product->price       = $request->input('price');
        $product->qty         = $request->input('qty');
        $product->images      = $images;
        $product->entry_date  = date('Y-m-d');
        try{
            $product->save();
            return $this->successApiResponse(200, 'Product Store Successfully');
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        }
    }

    public function show(Product $product){
        try{
            return $this->successApiResponse(200, 'Product Fetching Successfully', $product);
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        }  
    }


    public function update(ProductEditRequest $request, Product $product){
        if($request->hasFile('images')){
            $images = $request->file('images')->store('product', 'public');
        }else{
            $images = $product->images;
        }

        $product->name        = $request->input('name');
        $product->description = $request->input('description');
        $product->price       = $request->input('price');
        $product->qty         = $request->input('qty');
        $product->images      = $images;
        try{
            $product->save();
            return $this->successApiResponse(200, 'Product Updated Successfully');
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        }
    }


    public function delete(Product $product){
        try{
            $product->delete();
            return $this->successApiResponse(200, 'Product Delete Successfully');
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        }
    }


}
