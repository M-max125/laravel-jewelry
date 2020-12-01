<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($id){
        $product = Product::find($id);
        $moreItems = Product::where('id','!=',$id)->inRandomOrder()->take(6)->get();
        return view('products.productDetail')->with([
            'product'=>$product,
            'moreItems'=>$moreItems
        ]);
       }
}
