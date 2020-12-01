@extends('layouts.app')

@section('title','Checkout')


@section('extra-js')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')

<div class="container mt-50">

@if(session()->has('success_message'))
        <div class="alert alert-success">
        {{session()->get('success_message')}}
        </div>
        @endif

        @if(count($errors)>0)
        <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)
        <li>{!! $error !!}</li>
        @endforeach
        </ul>
        </div>
        @endif
    

    <div class="row">
        <!--First content-->
        <div class="col-md-6 first-content">
            <form action="{{route('checkout.store')}}" method="POST" id="payment-form">
                @csrf
                <!--Billing information-->
                <div class="row ml-2">
                    <h4 class="text-bold text-black-50">Billing Information</h4>
                </div>
                <hr>
                <div class="form-group">
                <label class="control-label" for="email">Email Adress: </label>
                  @if(auth()->user())
                  <input type="email" class="form-control" id="email" name="email" value="{{auth()->user()->email}}" readonly>
                  @else
                  <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required>
                  @endif
                
                </div>
            
                <div class="form-group">
                <label class="control-label" for="name">Full Name: </label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                </div>
              
            
                <div class="form-group">
                <label class="control-label" for="adress">Adress: </label>
                <input type="text" class="form-control" id="adress" name="adress" value="{{old('adress')}}" required>
                </div>
             
            
                <div class="form-group">
                    <div class="row">
                    
                        <div class="col-sm-6">
                            <label class="control-label" for="city">City: </label>
                            <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label" for="province">Province: </label>
                            <input type="text" class="form-control" id="province" name="province" value="{{old('province')}}" required>
                        </div>
                </div>
                
                
            
                <div class="form-group mt-2">
                    <div class="row">
                        
                        <div class="col-sm-6">
                        <label class="control-label" for="zip">Zip/Postal Code: </label>
                        <input type="text" class="form-control" id="zip" name="zip" value="{{old('zip')}}" required>
                        </div>
                        
                        <div class="col-sm-6">
                        <label class="control-label" for="phone">Phone: </label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" required>
                        </div>
                    </div>
                
                
                </div>
            <!--End billing information-->
            <!--Payment information-->
            <div class="row ml-2">
                    <h4 class="text-bold text-black-50">Payment Information</h4>
                    <div class="col-md-12 col-sm-6">
                    <img class="img-responsive pull-left" src="http://i76.imgup.net/accepted_c22e0.png">
                    </div>
            </div>
            <hr>

            <div class="form-group">
              <label class="control-label">Card Holder Name</label>
              <input type="text" class="form-control" id="cardHolder" name="cardHolder" value="">
            
            </div>

            <div class="form-group">
                <label for="card-element">
                Credit or debit card 
                </label>
                <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
            </div>

           <div class="form-group">
                <input type="submit" id="complete_order" class="btn btn-primary btn-classified" value="Complete order">
                    
                
            </div>

            </form>
            
        </div>
    </div>
  <!--First content: End -->
  
  <!--Second content: Start -->
  <div class="col-md-6 second-content">

  <div class="card shopping-cart">
            <div class="card-header bg-primary text-light">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                Your order
                
            </div>
            
            <div class="card-body">
                    <!-- PRODUCT -->
                    @foreach(Cart::content() as $item)
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 text-center">
                                <img class="img-responsive" src="{{asset('/images/'.$item->model->image.'.jpg')}}" alt="prewiew" width="90" height="60">
                        </div>
                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                            <h6 class="product-name"><strong>{{$item->model->name}}</strong></h6>
                            
                                <small>&euro;{{$item->model->price}}</small>
                            
                        </div>
                        
                    </div>
                    <hr>
                    @endforeach
                    <!-- END PRODUCT -->
                    
                
            </div>
            
            <div class="card-footer">
                
            <div class="bt-right" style="margin: 7px">
                    
                    
                        <p><b>Subtotal : &euro;{{($subtotal)}}</b></p>
                        <p><b>Tax (19%) :&euro;{{formatPrice($tax)}}</b></p>
                        <p><b>Total : &euro;{{formatPrice($total)}}</b></p>
                   
                </div>
            </div>
        </div>
  </div>
  
    
</div>

@endsection

@section('stripe-js')

<script>

    (function(){
        // Create a Stripe client.
var stripe = Stripe('pk_test_51HhdwgBbFmARJ9zXLVoVgGRO0LmWN2ntkFFuU5nDYh8pWkpGw1syd3CF81yRR0CHQvkuwvseGPQMGB5pBqV4XQWm006r85rL8y');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Nunito","Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {
    style: style,
    hidePostalCode: true});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  //Disable the submit button to prevent double clicking
  document.getElementById('complete_order').disabled = true;

  var options = {
      name: document.getElementById('cardHolder').value,
      adress_line1: document.getElementById('adress').value,
      adress_city: document.getElementById('city').value,
      adress_state: document.getElementById('province').value,
      adress_zip: document.getElementById('zip').value
  }

  stripe.createToken(card,options).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;

      //Enable the submit button
      document.getElementById('complete_order').disabled = false;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
    })();
</script>

@endsection