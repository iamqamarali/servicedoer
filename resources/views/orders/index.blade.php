@extends('layouts.app')

@section('content')
<section id="orders">
    <div class="container">
        <div class="row">
            <h3 class="active-order">Orders</h3>
        </div>

        @include('partials.messages')
        @include('partials.errors')

        @foreach ($orders as $order)            
            <div class="row active-row">
                <div class="col-md-3 customer-profile2">
                    <div class="row">
                        <div class="col-md-3 text-center customer-profile2">
                            <img src="images/manager.png" alt="customer" class="customer" />
                        </div>
                        <div class="col-md-9 customer-info">
                            <a href="{{ route('service-provider.profile', $order->service_provider->id) }}">
                                <h4>{{ $order->service_provider->name }}</h4>
                            </a>
                            <i class="fas fa-map-marker-alt map-sign"></i> {{ $order->service_provider->address }}  {{ $order->service_provider->city->name }}
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-center price-order">
                    <h4>Price</h4>
                    {{ $order->amount }}
                </div>
                <div class="col-md-3 text-center things">
                    <h4>Service</h4>
                    {{ $order->project->service->name }}
                </div>
                <div class="col-md-2 text-center status2">
                    <h4>Status</h4>
                    @if ($order->status == 'In Progress')
                        <span class="progress">{{ $order->status }}</span>
                    @elseif($order->status == 'Completed')
                        <span class="completed-order">{{ $order->status }}</span>
                    @elseif($order->status == 'Cancelled')
                        <span class="cancelled-order">{{ $order->status }}</span>
                    @endif
                </div>
                @if ($order->status == 'In Progress')
                    <div class="col-md-2 text-center order-btns">
                        <button class="order-btn order-complete-btn" order-id="{{ $order->id }}" data-toggle="modal" data-target="#order-complete-modal">Order Complete</button>
                        <button class="cancel-btn order-cancel-btn" order-id="{{ $order->id }}" data-toggle="modal" data-target="#order-cancel-modal">Cancel Order</button>
                        <a href="/orders/{{$order->id}}" class="cancel-btn order-details-btn" order-id="{{ $order->id }}" >Order Details</a>
                    </div>
                @else
                    <div class="col-md-2 text-center order-btns">
                        <a href="/orders/{{$order->id}}" class="cancel-btn order-details-btn" order-id="{{ $order->id }}" >Order Details</a>
                    </div>
                @endif
            </div>
        @endforeach

        {{-- <div class="row active-row">
            <div class="col-md-3 customer-profile2">
                <div class="row">
                    <div class="col-md-3 text-center customer-profile2">
                        <img src="images/manager.png" alt="customer" class="customer" />
                    </div>
                    <div class="col-md-9 customer-info">
                        <h4>Laim Parker</h4>
                        <i class="fas fa-map-marker-alt map-sign"></i> Sector D Lahore,Pakistan
                    </div>
                </div>
            </div>
            <div class="col-md-2 text-center price-order">
                <h4>Price</h4>
                Rs.300
            </div>
            <div class="col-md-3 text-center things">
                <h4>Things to be done</h4>
                Teach Maths
            </div>
            <div class="col-md-2 text-center">
                <h4>Status</h4>
                <span class="completed-order">Completed</span>
            </div>
            <div class="col-md-2 text-center order-btns"></div>
        </div>
        <div class="row active-row">
            <div class="col-md-3 customer-profile2">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="images/manager.png" alt="customer" class="customer" />
                    </div>
                    <div class="col-md-9 customer-info">
                        <h4>Laim Parker</h4>
                        <i class="fas fa-map-marker-alt map-sign"></i> Sector D Lahore,Pakistan
                    </div>
                </div>
            </div>
            <div class="col-md-2 text-center price-order">
                <h4>Price</h4>
                Rs.300
            </div>
            <div class="col-md-3 text-center">
                <h4>Things to be done</h4>
                Teach Maths
            </div>
            <div class="col-md-2 text-center">
                <h4>Status</h4>
                <span class="cancelled-order">Cancelled</span>
            </div>
            <div class="col-md-2 text-center order-btns"></div>
        </div> --}}
    </div>
</section>

<!-- order complete modal -->
<div class="modal fade" id="order-complete-modal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Order Completion</h4>
        </div>
        <div class="modal-body">
          <form action="" class="review-service review-form" method="post">
              @csrf
              <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-10">
                    <div class="form-group">
                        <label for="modal-para1" class="modal-para1">How much you were satisfied with the service?</label>
                    </div>
                  </div>
                  <div class="col-md-1"></div>
              </div>
              <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                      <div class="form-group">
                          <label for="modal-para1" class="location-info rating-stars">
                            <i class="fas fa-star stars2 star"></i>
                            <i class="fas fa-star stars2 star"></i>
                            <i class="fas fa-star stars2 star"></i>
                            <i class="fas fa-star stars2 star"></i>
                            <i class="fas fa-star stars2 star"></i>
                         </label>
                         <input type="text" class="rating-input d-none" hidden name="rating" >
                      </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
              <div class="row">
                 <div class="col-md-1"></div> 
                 <div class="col-md-10">
                     <div class="form-group">
                        <label for="modal-para1" class="modal-para2">Please leave a review for the <span class="service-provider"></span></label>
                        <textarea name="review" cols="30" rows="3" class="form-control reviews-area"></textarea>
                     </div>
                 </div>    
                  <div class="col-md-1"></div>  
              </div>
              <div class="row">
                    <div class="col-md-4"></div> 
                    <div class="col-md-4 text-center">
                       <button type="submit" class="continue-review">Complete Order</button>
                    </div>    
                    <div class="col-md-4"></div>  
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- order cancel modal -->
<div class="modal fade " id="order-cancel-modal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cancellation of order</h4>
        </div>
        <div class="modal-body">
          <form action="" class="review-service order-cancel-form" method="post">
              @csrf
              <div class="row">
                 <div class="col-md-1"></div> 
                 <div class="col-md-10">
                     <div class="form-group">
                        <label for="modal-para1" class="modal-para2">Why do you wish to cancel the order?</label>
                        <textarea name="cancellation_reason" cols="30" rows="4" class="form-control reviews-area"></textarea>
                     </div>
                 </div>    
                  <div class="col-md-1"></div>  
              </div>
              <div class="row">
                    <div class="col-md-4"></div> 
                    <div class="col-md-4 text-center">
                       <button class="continue-review2">Continue</button>
                    </div>    
                     <div class="col-md-4"></div>  
              </div>
          </form>
        </div>

      </div>
      
    </div>
  </div>
</div>

@endsection


@push('scripts')
<script>
    var $stars = $('.rating-stars .star');
    $('.rating-stars .star').click(function(){
        var index = $(this).index()
        $stars.each(function(i, el){
            $(el).removeClass('stars')
            $(el).addClass('stars2')
        })
        for(var i = 0 ; i < index + 1 ; i++ ){
            $($stars[i]).removeClass('stars2')
            $($stars[i]).addClass('stars')
        }
        $('.rating-input').val(index+1)        
    })
    $('.order-complete-btn').click(function(){
        var orderId = $(this).attr('order-id')
        $('.review-form').attr('action', '/orders/'+ orderId +'/mark-complete');
    })
    $('.order-cancel-btn').click(function(){
        var orderId = $(this).attr('order-id')
        $('.order-cancel-form').attr('action', '/orders/'+orderId+'/mark-cancel');        
    })

</script>
@endpush
    