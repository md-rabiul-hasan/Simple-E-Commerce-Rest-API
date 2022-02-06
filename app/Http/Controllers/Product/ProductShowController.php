<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductShowController extends Controller
{
    
    /**
     * Product List
     * @responseField success The success of this API response is (`true` or `false`).
     * 
     * @response 200{
     *      "success": true,
     *      "status": 200,
     *      "message": "Product List",
     *      "data": [
     *          {
     *              "id": 2,
     *              "name": "Computer",
     *              "description": "Laptop core i3",
     *              "price": "60000.00",
     *              "qty": 1,
     *              "images": "product/33XB8eHBgORRpF0cW3WyoCEm8ELD793zuFIpOuri.jpg",
     *              "entry_date": "2022-02-06"
     *          },
     *          {
     *              "id": 3,
     *              "name": "Mobile",
     *              "description": "Redmi",
     *              "price": "10000.00",
     *              "qty": 3,
     *              "images": "product/ZNVLUKAAu7aNWug4GufltLYPJkT6F256kFlBJ7K5.jpg",
     *              "entry_date": "2022-02-06"
     *          }
     *      ]
     *  }
     * 
     */
    public function index(){
        try{
            $products = Product::select(['id','name','description','price','qty','images','entry_date'])->get();
            return $this->successApiResponse(200, 'Product List', $products);
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        } 
    }


    /**
     * Product Searching
     * @responseField success The success of this API response is (`true` or `false`).
     * 
     * @response 200{
     *      "success": true,
     *      "status": 200,
     *      "message": "Product Searching Result",
     *      "data": [
     *          {
     *              "id": 2,
     *              "name": "Computer",
     *              "description": "Laptop core i3",
     *              "price": "60000.00",
     *              "qty": 1,
     *              "images": "product/33XB8eHBgORRpF0cW3WyoCEm8ELD793zuFIpOuri.jpg",
     *              "entry_date": "2022-02-06"
     *          }
     *      ]
     *  }
     * 
     */
    public function search($product_name){
        try{
            $products = Product::select(['id','name','description','price','qty','images','entry_date'])->where('name','LIKE','%'.$product_name.'%')->get();
            return $this->successApiResponse(200, 'Product Searching Result', $products);
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        }         
    }


    /**
     * Product Sorting Highest To Lowest Price
     * @responseField success The success of this API response is (`true` or `false`).
     * 
     * @response 200{
     *       "success": true,
     *       "status": 200,
     *       "message": "Product Sorting Success",
     *      "data": [
     *          {
     *              "id": 3,
     *              "name": "Mobile",
     *              "description": "Redmi",
     *              "price": "10000.00",
     *              "qty": 3,
     *              "images": "product/ZNVLUKAAu7aNWug4GufltLYPJkT6F256kFlBJ7K5.jpg",
     *              "entry_date": "2022-02-06"
     *          },
     *          {
     *              "id": 2,
     *              "name": "Computer",
     *              "description": "Laptop core i3",
     *              "price": "60000.00",
     *              "qty": 1,
     *              "images": "product/33XB8eHBgORRpF0cW3WyoCEm8ELD793zuFIpOuri.jpg",
     *              "entry_date": "2022-02-06"
     *          }
     *      ]
     *  }
     * 
     */
    public function highestToLowest(){
        try{
            $products = Product::select(['id','name','description','price','qty','images','entry_date'])->orderBy('price', 'desc')->get();
            return $this->successApiResponse(200, 'Product Sorting Success', $products);
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        } 
    }


    
    /**
     * Product Sorting Lowest To Highest Price
     * @responseField success The success of this API response is (`true` or `false`).
     * 
     * @response 200{
     *       "success": true,
     *       "status": 200,
     *       "message": "Product Sorting Success",
     *      "data": [
     *          {
     *              "id": 2,
     *              "name": "Computer",
     *              "description": "Laptop core i3",
     *              "price": "60000.00",
     *              "qty": 1,
     *              "images": "product/33XB8eHBgORRpF0cW3WyoCEm8ELD793zuFIpOuri.jpg",
     *              "entry_date": "2022-02-06"
     *          },
     *          {
     *              "id": 3,
     *              "name": "Mobile",
     *              "description": "Redmi",
     *              "price": "10000.00",
     *              "qty": 3,
     *              "images": "product/ZNVLUKAAu7aNWug4GufltLYPJkT6F256kFlBJ7K5.jpg",
     *              "entry_date": "2022-02-06"
     *          }
     *      ]
     *  }
     * 
     */
    public function lowestToHighest(){
        try{
            $products = Product::select(['id','name','description','price','qty','images','entry_date'])->orderBy('price', 'asc')->get();
            return $this->successApiResponse(200, 'Product Sorting Success', $products);
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        } 
    }

}
