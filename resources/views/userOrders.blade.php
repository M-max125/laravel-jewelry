@extends('layouts.app')

@section('title','My orders')

@section('content')
<div class="container" style="padding-top: 60px;">
  
    <div class="row">
        <!-- left column -->
        <div class="col-md-4 col-sm-6 col-xs-12">
        
            <div class="text-center">
        
                <div class="vertical-menu ml-3">
                
                    <a href="{{route('profile.edit')}}">My profile</a>
                    <a href="{{route('orders.index')}}">My orders</a>
                
                </div>

            </div>
        </div>
        <!-- right column -->
        <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
        
            
            @foreach($orders as $order)
            
                    <div class="card-header bg-secondary text-white mt-2">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="text-center">ORDER PLACED : </div>
                                    <div class="text-center">{{formatDate($order->created_at)}}</div>
                                </div>

                                <div class="col-md-3">
                                    <div class="text-center">ORDER ID :</div>
                                    <div class="text-center">{{$order->id}}</div>
                                </div>

                                <div class="col-md-3">
                                    <div class="text-center">TOTAL:</div>
                                    <div class="text-center"> &euro;{{formatPrice($order->billing_total)}}</div>
                                </div>

                                <div class="col-md-3 col-sm-12">
                                <a href="{{route('orders.show',$order->id)}}" class="btn btn-outline-info btn-sm float-right">Order Details</a>
                                </div>
                            </div>

                            
                    </div><!--End card-header-->
                    @foreach($order->products as $product)

                    <div class="row mt-2">
                        <div class="col-md-4">
                        <a href="{{route('products',$product->id)}}"> <img src="{{asset('images/'.$product->image.'.jpg')}}" class="img-thumbnail img-fluid" width="70" height="70"></a>
                           
                        </div>
                        <div class="col-md-8 px-3">
                            <div class="card-block px-3">
                                <h6 class="card-title">Product name : {{$product->name}}</h6>
                                <p class="card-text small">Product price : &euro;{{$product->price}} </p>
                                
                            </div>
                            

                        </div>
                    </div>
                    <hr>
                    @endforeach
        
            <!--End card-->
            @endforeach
        
           

           
        </div><!--End right column-->
        
        
        
  </div><!--End row-->
</div><!--End container-->

@endsection

