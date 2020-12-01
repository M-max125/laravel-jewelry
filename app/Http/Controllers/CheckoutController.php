<?php

namespace App\Http\Controllers;
use Cart;
use Stripe;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Exception\CardErrorException;
use App\Http\Requests\CheckoutRequest;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        if(auth()->user() && request()->is('checkoutGuest')){
            
            return redirect()->route('checkout.index');
        }
        
        
        
        return view('products.checkout')->with([
            'subtotal'=>$this->getNumbers()->get('subtotal'),
            'tax' =>$this->getNumbers()->get('tax'),
            'total'=>$this->getNumbers()->get('total')
        ]);
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
    public function store(CheckoutRequest $request)
    {
        //Retrieving values for Stripe account
        $contents = Cart::content()->map(function($item){
            return $item->model->id.','.$item->name.','.$item->qty;
        })->values()->toJson();
        
        try{
            $charge = Stripe::charges()->create([
                'amount' => $this->getNumbers()->get('total'),
                'currency' => 'EUR',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    //Change to order Id after we start using DB
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count()
                ]

            ]);

            $this->addToOrdersTable($request,null);
            
            //SUCCESS
            Cart::instance('default')->destroy();
            return back()->with('success_message','Thank you! Your payment has been successfully accepted!');

        }catch(CardErrorException $e){
            $this->addToOrdersTable($request,$e->getMessage());
            return back()->withErrors('Error! '.$e->getMessage());
        }
    }

    protected function addToOrdersTable($request,$error){
        //Insert into orders table
        $order = Order::create([
            'user_id'  => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_adress' => $request->adress,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_zip' => $request->zip,
            'billing_phone' => $request->phone,
            'billing_cardHolder' => $request->cardHolder,
            'billing_subtotal' => $this->getNumbers()->get('subtotal'),
            'billing_tax' => $this->getNumbers()->get('tax'),
            'billing_total' => $this->getNumbers()->get('total'),
            'error' => $error

        ]);

        //Insert into order_products table

        foreach(Cart::content() as $item){
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' =>$item->model->id
            ]);
        }
    }

    private function getNumbers(){
        $subtotal = Cart::subtotal();
        $tax = Cart::tax();
        $total = Cart::total();

        return collect([
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        //
    }
}
