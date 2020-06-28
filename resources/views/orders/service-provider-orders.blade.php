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
                            <h4>{{ $order->service_provider->name }}</h4>
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
                <div class="col-md-2 text-center order-btns">
                    <a href="/service-provider/orders/{{$order->id}}" class="cancel-btn order-details-btn" order-id="{{ $order->id }}" >Order Details</a>
                </div>
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
@endsection