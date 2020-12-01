@extends('layouts.app')

@section('title','Order details')

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
        
            
           
            
                    <div class="card-header bg-secondary text-white mt-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center">ORDER PLACED : </div>
                                    <div class="text-center">{{formatDate($order->created_at)}}</div>
                                </div>

                                <div class="col-md-4">
                                    <div class="text-center">ORDER ID :</div>
                                    <div class="text-center">{{$order->id}}</div>
                                </div>

                                <div class="col-md-4">
                                    <div class="text-center">TOTAL:</div>
                                    <div class="text-center"> &euro;{{formatPrice($order->billing_total)}}</div>
                                </div>

                                
                            </div>

                            
                    </div><!--End card-header-->
                    

                    <div class="row mt-2">
                        
                        <div class="col-md-12 px-3">
                            <div class="card-block px-3">
                                <p class="card-text"><strong>Name :</strong> {{$order->user->name}}</p>
                                <p class="card-text"><strong>Adress :</strong>{{$order->billing_adress}}</p>
                                <p class="card-text"><strong>City :</strong>{{$order->billing_city}}</p>
                                <p class="card-text"><strong>Province :</strong>{{$order->billing_province}}</p>
                                <p class="card-text"><strong>Postal code :</strong>{{$order->billing_zip}}</p>
                                <p class="card-text"><strong>Phone :</strong>{{$order->billing_phone}}</p>
                                <p class="card-text"><strong>Order Subtotal :</strong>&euro;{{$order->billing_subtotal}}</p>
                                <p class="card-text"><strong>Tax :</strong>&euro;{{formatPrice($order->billing_tax)}}</p>
                                <p class="card-text"><strong>Order Total :</strong>&euro;{{formatPrice($order->billing_total)}} </p>
                                
                            </div>
                            

                        </div>
                    </div>
                    <hr>
                    
        
            <!--End card-->
           
        
           

           
        </div><!--End right column-->
        
        
        
  </div><!--End row-->
</div><!--End container-->



@endsection