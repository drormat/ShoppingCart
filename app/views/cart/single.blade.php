@extends('layout')

@section('title')
"Shopping Cart"
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9 cart-items-container">
            <div hidden>{{$sum = 0;}}</div>
           @foreach($cartItems as $product)
               <div class="col-sm-4 col-lg-4 col-md-4">
                 <div class="thumbnail">
                   <img src="http://placehold.it/320x120" alt="">
                   <div class="caption caption-checkout">
                       <h4 class="pull-right">${{ number_format($product->pricing, 2);}}</h4>
                       <h4><a href="{{url('products/'.$product->slug)}}">{{$product->name}}</a></h4>
                       <p>{{$product->short_description}}</p>
                       <p>Amount of items: <b>{{$product->amount}}</b></p>
                       <h4 class="pull-right">Total: ${{ number_format($product->pricing*$product->amount, 2);}}</h4>
                       <div hidden>{{$sum+=$product->pricing*$product->amount }}</div>
                       <button class="btn btn-remove" onclick="cartHandler.removeFromCart({{$product->id}},true)">Remove Item</button>
                   </div>
                   <div class="ratings">
                       <p class="pull-right">{{$product->rating_count}} {{ Str::plural('review', $product->rating_count);}}</p>
                       <p>
                           @for ($i=1; $i <= 5 ; $i++)
                               <span class="glyphicon glyphicon-star{{ ($i <= $product->rating_cache) ? '' : '-empty'}}"></span>
                           @endfor
                       </p>
                   </div>
                 </div>
               </div>
           @endforeach
        </div>
    </div>
    <h2 style="margin-left:20%">Total price:<b>${{$sum}}</b></h2>
    <button class="btn checkout-btn">Pay with DreamPay</button>
@stop