@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-7">
    <div class="row">
      <div class="col-md-12">
        Area reserved for google map api
        <br>
        <br>
        <br>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
          <a href="{{route('orders.create')}}">
            <button class="btn btn-primary btn-lg btn-block"> New Order</button>
          </a>
      </div>
    </div>
    
  </div>
  <div class="col-md-5">
    @if ($user !== null)
      <h3>All available orders</h3>
        {{-- <h6>TODO: This Page should display all orders submitted by the current user</h6> --}}
        @if (count($availableOrders) > 0)
          <ul class="list-group list-group-flush" id="listOfTakeButtons">
            @foreach($availableOrders as $availableOrder)
              <li class="list-group-item list-group-item-action">
                {{-- <a href="{{route('orders.show', $order->id)}}">{{$order->title}}</a>
                <span>Order owner: {{$order->owner}}</span>
                @if ($order->owner !== $user->name)
                <a href="" class="btn btn-default">
                <button class="btn btn-primary" id="{{$order->id}}">Take</button>
                </a>
                @endif --}}
                <span>Order title: <b>{{$availableOrder->title}}</b> </span><br>
                <span>Order owner: <b>{{$availableOrder->owner}}</b> </span>
                <a class="btn btn-default">
                  <button class="btn btn-primary" id="{{$availableOrder->id}}">Take</button>
                </a>
              </li>
            @endforeach
          </ul>
        @else
        <h5>You are late~ No available order.</h5>
        @endif
          
      <hr style="border-top: 3px solid rgba(0,0,0,.1);">  
      <h3>Orders you have posted</h3>
      @if (count($ordersFromCurrentUsers) > 0)
        <ul class="list-group list-group-flush">
            {{-- this is for displaying the orders that are created by the currently logged in user --}}
            @foreach($ordersFromCurrentUsers as $ordersFromCurrentUser)
              @if ($ordersFromCurrentUser->owner === $user->name)
                <li class="list-group-item list-group-item-action">
                  <a href="{{route('orders.show', $ordersFromCurrentUser->id)}}">{{$ordersFromCurrentUser->title}}</a>
                </li>
              @endif
            @endforeach
        </ul>
      @else
        <h4>You currently have not placed any orders. Try to Create one.
        </h4>
      @endif
      @else
        <p>You need to login to view all orders you have submitted.</p>
    </div>
    @endif
</div>

<div class="row" style="width: 100%; margin-top: 30px;">
  <div class="col-md-12">
    <table style="width: 100%;">
      <h4>The following table is solely for debugging purpose.</h4>
      <h4>When we do final demo, this table will be removed.</h4>
      <tr>
        <th>order id</th>
        <th>title</th>
        <th>item</th>
        <th>owner</th>
        <th>taker</th>
        <th>latitude</th>
        <th>longtitude</th>
      </tr>
      @foreach ($orders as $order)
      <tr>
        <td style="margin-right: 5px;">{{$order->id}}</td>
        <td>{{$order->title}}</td>
        <td style="margin-right: 5px;">{{$order->item}}</td>
        <td style="margin-right: 5px;">{{$order->owner}}</td>
        <td style="margin-right: 5px;">{{$order->taker}}</td>
        <td style="margin-right: 5px;">{{$order->latitude}}</td>
        <td style="margin-right: 5px;">{{$order->longitude}}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
    
@endsection
<script
  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
  crossorigin="anonymous">
</script>
<script>
  $(document).ready(function(){
    $("#listOfTakeButtons button").click(function(e){
      e.preventDefault(); 
      let orderId = this.id; // first, get the id of the order, which is wriiten as ID of the button element
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
          type: 'post',
          url: `orders/take/${orderId}`,
          success: function(msg) {
            console.log('ajax take order success'); 
            alert('You have taken the order successfully');
            window.location.reload(true); 
          },
          error: function(msg) {
            alert('Fail to take the order successfully');
            console.log('ajax call to takeOrder action in order controller error ', msg);
            window.location.reload(true); 
          }
      });
    });
});
</script>