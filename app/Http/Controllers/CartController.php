<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {/*Checking for duplicate item in cart*/ 
        $duplicate = Cart::search(function($cartItem,$rowId) use($request){
            return $cartItem->id === $request->id;
        });

        if($duplicate->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message','Item is already in your card!');
        }
        Cart::add($request->id,$request->name,1,$request->price)->associate('App\Models\Product');
        return redirect()->route('cart.index')->with('success_message','Item was added to your cart!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('success_message','Item has been removed!');
    }

    /**
     * Save item for later in shopping cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveForLater($id)
    {
        $item = Cart::get($id);
        Cart::remove($id);

        $duplicate = Cart::instance('saveForLater')->search(function($cartItem,$rowId) use($id){
            return $rowId === $id;
        });

        if($duplicate->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message','Item is already saved for later!');
        }

        Cart::instance('saveForLater')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        return redirect()->route('cart.index')->with('success_message','Item has been saved for later!');
    }
}
