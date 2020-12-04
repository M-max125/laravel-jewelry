@extends('layouts.app')

@section('title','Product Details')
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

   <div class="pd-wrap">
		<div class="container">
            <div class="heading-section">
                  <h2>Product Details</h2>
            </div>
	      <div class="row">
               
                  <div class="col-md-6">
                  <img src="{{secure_asset('images/'.$product->image.'.jpg')}}" class="img-fluid img-thumbnail">
                  </div>
               
                  <div class="col-md-6">
                     <div class="product-dtl">
                        <div class="product-info">
                           <div class="product-name">{{$product->name}}</div>
                           
                              <div class="reviews-counter">
                                 <div class="rate">
                                 @for ($i = 0; $i <  $product->stars ; $i++)
                                    <i class="fas fa-star"></i>
                                 @endfor  
                                 </div>
                                 <span> Rating</span>
                              </div>
                              <div class="product-price"><span>&euro;{{$product->price}}</span></div>
                        </div>
                           <p>By definition, handmade jewelry is literally just that, made by the “hands” of the artisan or maker. The pieces are soldered, sawed, carved, and shaped without the use of manufacturing machinery. A machine can crank out hundreds of units per hour while an individual can only make a finite quantity. Why does this matter? Attention to detail, my friends! Your handmade jewelry will be far less likely to have flaws and imperfections than something made in bulk.</p>
                           
                              <div class="product-add-card">
                              <form action="{{route('cart.store')}}" method="POST">
                              @csrf
                              <input type="hidden" name="id" value="{{$product->id}}">
                              <input type="hidden" name="name" value="{{$product->name}}">
                              <input type="hidden" name="price" value="{{$product->price}}">
                              <button type="submit" class="round-black-btn">Add to cart</button>
                              </form>
                                 
                                 
                                 
                              </div>
                     </div>
                  </div>
         </div>
         <!--Tabs content-->
         <div class="product-info-tabs">
		        <ul class="nav nav-tabs" id="myTab" role="tablist">
				  	<li class="nav-item">
				    	<a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
				  	</li>
				  	<li class="nav-item">
				    	<a class="nav-link" id="items-tab" data-toggle="tab" href="#items" role="tab" aria-controls="items" aria-selected="false">More items</a></a>
                 </li>
               
				</ul>
				<div class="tab-content" id="myTabContent">
				  	<div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
				  		{{$product->description}}
				  	</div>
				  	<div class="tab-pane fade" id="items" role="tabpanel" aria-labelledby="items-tab">
                 
                 <div class="container">
                     <div class="row align-items-center">
                        <div class="col-12 col-carousel">
                           <div class="owl-carousel carousel-main">
                              @foreach($moreItems as $item)
                              <div>
                                 <a href="{{route('products',$item->id)}}">
                                    <img src="{{asset('images/'.$item->image.'.jpg')}}">
                                 </a>
                              </div>
                             
                              @endforeach
                             
                           </div>
                        </div>
                     </div>
                  </div>

				  		
                 </div>
                 
				</div>
			</div>
			
			
                              <div class="product-custom">
                                 
                                 <a href="{{route('home')}}" class="round-black-btn">Back</a>
                              </div>
      </div>
   </div>




@endsection