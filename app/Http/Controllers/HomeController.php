<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {
        $pagination = 12;
        $categories = Category::all();

        if(request()->category){
            $products = Product::with('category')->whereHas('category',function($query){
                $query->where('slug',request()->category);
            });
            $categoryName = optional($categories->where('slug',request()->category)->first())->name;
        }else{
            $products = Product::inRandomOrder()->take(18);
            $categoryName = 'Our Collection';
        }

        if(request()->sort == 'low_high'){
            $products = $products->orderBy('price','asc')->paginate($pagination);

        }elseif(request()->sort == 'high_low'){
            $products = $products->orderBy('price','desc')->paginate($pagination);
        }else{
            $products = $products->paginate($pagination);
        }
        
        return view('home')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' =>$categoryName
        ]);
    }

    public function search(Request $request){

        $request->validate([
            'query'=>'required|min:3',
        ]);
        $query = $request->input('query');
        $products = Product::where('name','like',"%$query%")
                            ->orWhere('description','like',"%$query%")
                            ->paginate(5);
        return view('products.searchResults')->with('products',$products);
    }
}
