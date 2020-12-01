@extends('layouts.app')

@section('title','Shopping Cart')

@section('content')
<div class="container mt-50">
   <div class="card shopping-cart">
        <div class="card-header bg-dark text-light">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Your Shopping cart
                <a href="{{route('home')}}" class="btn btn-outline-info btn-sm bt-right">Continue shopping</a>
                <div class="clearfix"></div>
        </div>
        @if(session()->has('success_message'))
        <div class="alert alert-success">
        {{session()->get('success_message')}}
        </div>
        @endif

        @if(count($errors)>0)
        <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        </ul>
        </div>
        @endif

       
            <div class="card-body">
                <!--Checking if the cart is empty-->
                    @if(Cart::count() > 0)
                    <h6 class="mx-3 text-bold text-success">{{Cart::count()}} item(s) in Shopping Cart</h6>
                    <!-- PRODUCT -->
                    @foreach(Cart::content() as $item)
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-2 text-center">
                        <a href="{{route('products',$item->model->id)}}"><img class="img-responsive" src="{{asset('/images/'.$item->model->image.'.jpg')}}" alt="prewiew" width="100" height="80"></a>
                                
                        </div>
                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                            <h5 class="product-name"><strong>{{$item->model->name}}</strong></h5>
                            
                                <small>{{$item->model->description}}</small>
                            
                        </div>
                        <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                            <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                                <h6 class="min"><strong>&euro;{{$item->model->price}} </strong></h6>
                            </div>

                            <div class="col-4 col-sm-4 col-md-4">
                            <!--Save item for later-->
                            <form action="{{route('cart.savedItems',$item->rowId)}}" method="POST">
                                @csrf
                                
                                <button type="submit" class="btn btn-outline-danger btn-xs"><i class="fa fa-heart" aria-hidden="true"></i></button>
                                </form>
                            </div>
                            
                            <div class="col-2 col-sm-2 col-md-2 text-right">
                            <!--Remove item-->
                                <form action="{{route('cart.destroy',$item->rowId)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- END PRODUCT -->
                @endforeach   
                @else
                    <div class="alert alert-info">No items in Cart!</div>
                @endif
            </div>
            
            <div class="card-footer">
                
                <div class="bt-right" style="margin: 10px">
                    <a href="{{route('checkout.index')}}" class="btn btn-success bt-right" style="margin-left: 20px">Checkout</a>
                    <div class="bt-right" style="margin: 5px">
                        <p><b>Subtotal : &euro;{{Cart::subtotal()}}</b></p>
                        <p><b>Tax (19%) : &euro;{{formatPrice(Cart::tax())}}</b></p>
                        <p><b>Total : &euro;{{formatPrice(Cart::total())}}</b></p>
                    </div>
                </div>
            </div>
            <!--Saved items section-->
        @if(Cart::instance('saveForLater')->count() > 0)
            <h6 class="mx-3 text-bold text-danger">{{Cart::instance('saveForLater')->count()}} item(s) saved for later</h6>
            <div class="container">
            @foreach(Cart::instance('saveForLater')->content() as $item)
            <div class="row">
                        <div class="col-12 col-sm-12 col-md-2 text-center">
                        <a href="{{route('products',$item->model->id)}}"><img class="img-responsive" src="{{asset('/images/'.$item->model->image.'.jpg')}}" alt="prewiew" width="100" height="80"></a>
                                
                        </div>
                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                            <h5 class="product-name"><strong>{{$item->model->name}}</strong></h5>
                            
                                <small>{{$item->model->description}}</small>
                            
                        </div>
                        <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                            <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                                <h6 class="min"><strong>&euro;{{$item->model->price}} </strong></h6>
                            </div>

                            <div class="col-4 col-sm-4 col-md-4">
                            <!--Move item back to cart-->
                            <form action="{{route('savedItems.toCart',$item->rowId)}}" method="POST">
                                @csrf
                                
                                <button type="submit" class="btn btn-outline-danger btn-xs"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                                </form>
                            </div>
                            
                            <div class="col-2 col-sm-2 col-md-2 text-right">
                            <!--Remove item from saved items section-->
                                <form action="{{route('savedItems.destroy',$item->rowId)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
            </div>
                    <hr>
                    @endforeach
            </div>
                    @else
                    <h6 class="mx-3 text-bold text-danger">You have no saved items.</h6>
                    @endif


        </div>
        
</div>

@endsection
