@extends('layouts.app')

@section('title','Home')

@section('content')

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
<main>
  <section class="mast">
    
    <header class="mast__header">
      <h1 class="mast__title js-spanize">Unique pieces of adornment</h1> 
      <hr class="sep"/>
      <p class="mast__text js-spanize">
      
      Our collection  is  one of a kind.
      Dainty rings, necklaces, earrings and bracelets.
      Handmade at GlamourLANE with love.
    </p>

    </header>
  </section>
</main>

<div class="sidebar">
@foreach($categories as $category)
<a href="{{route('home',['category' => $category->slug])}}">{{$category->name}}</a>
@endforeach
  

</div>


<div class="content-shop">
  <div class="container mt-40">
  
    <h3 class="text-center italic text-danger">{{$categoryName}}</h3>
      <div>
      <strong class="text-danger">Filter by Price  </strong>
      
      <a href="{{route('home',['category' => request()->category,'sort' => 'low_high'])}}">Low to High</a>
      <a href="{{route('home',['category' => request()->category,'sort' => 'high_low'])}}">High to Low</a>
      </div>
  
   
              <div class="row mt-30">
                  @forelse($products as $product)
                 
                      <div class="col-6 col-md-2 col-sm-6 mb-30">
                          <div class="box1 ">
                              <img src="{{asset('images/'.$product->image.'.jpg')}}">
                              
                              <h3 class="title">{{$product->name}}</h3>
                              <div class="box-content">
                                  <ul class="icon">
                                      <li><a href="{{'/'.$product->id.'/products'}}"><i class="fa fa-search"></i> </a> </li>
                                      
                                  </ul>
                              </div>
                          </div>
                          <h6 class="text-center mt-2">&euro;{{$product->price}}</h6>
                      </div>

                  @empty
                      <div>No items found</div>
                  
                  @endforelse

                  
                </div>
                <!--End row-->
              <div class="pag">
                  
                  {{$products->appends(request()->input())->links()}}
              </div>

             
              
  </div>
  <!--End container--> 
</div>
<!--End content-shop-->  



   
                

                

                

                
                
        
@endsection
    
    
