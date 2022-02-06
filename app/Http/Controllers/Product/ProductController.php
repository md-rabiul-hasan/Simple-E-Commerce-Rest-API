<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
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
}
