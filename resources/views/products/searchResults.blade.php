@extends('layouts.app')

@section('title','Search Results')

@section('content')

       
<div class="container mt-50">
   <div class="card shopping-cart">
        <div class="card-header bg-primary text-light">
                <i class="fa fa-search-plus" aria-hidden="true"></i>
                Your search results
                <p class="btn btn-outline-warning btn-sm bt-right">{{$products->total()}} results for '{{request()->input('query')}}'</p>
                <div class="clearfix"></div>
        </div>
        @if(session()->has('success_message'))
        <p class="alert alert-success">
        {{session()->get('success_message')}}
        </p>
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
               
                    
                    @foreach($products as $product)
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-2 text-center">
                        <a href="{{route('products',$product->id)}}"><img class="img-responsive" src="{{asset('/images/'.$product->image.'.jpg')}}" alt="prewiew" width="90" height="60"></a>
                                
                        </div>
                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                            <h5 class="product-name"><strong>{{$product->name}}</strong></h5>
                            
                                <small>{{Str::limit($product->description,80)}}</small>
                            
                        </div>
                        <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                            <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                            <h6 class="min"><strong>&euro;{{$product->price}} </strong></h6>
                            </div>

                            <div class="col-4 col-sm-4 col-md-4">
                            
                           
                            </div>
                            
                            <div class="col-2 col-sm-2 col-md-2 text-right">
                            
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    
                
               
            </div>
            
            <div class="pag m-3">
                  
                  {{$products->appends(request()->input())->links()}}
              </div>
           


        </div>
        
</div>

@endsection
