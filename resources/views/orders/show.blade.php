@extends('layouts.app')

@section('content')

<section id="orders">
    <div class="container">
        <div class="row">
            <h3 class="active-order">Order Details</h3>
        </div>
        <div class="row active-row active-row2">
            <div class="col-md-4 customer-profile2">
                <h4 class="order-id">Order #{{ $order->id }}</h4>
                <p>Seller:&nbsp; {{ $order->service_provider->name }}&nbsp;&nbsp;&nbsp;<a href="{{ route('service-provider.profile', $order->service_provider_id) }}" class="order-profile">View Profile</a></p>
                   <p class="order-location"><i class="fas fa-map-marker-alt map-sign map-sign2"></i> {{ $order->service_provider->address }}  {{ $order->service_provider->city->name }},Pakistan</p>
            </div>
            <div class="col-md-2 text-center things">
                <h4>Phone #</h4>
                {{ $order->service_provider->phone }}
            </div>
            <div class="col-md-2 text-center things">
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
            <div class="col-md-2 text-center order-price">Rs.{{ $order->amount }}</div>
        </div>
        
        <hr class="order-border"/>


        @foreach ($order->project->questions as $question)
            <div class="row order-subjects">
                <div class="col-md-6">
                    <h4 class="order-id">{{$question->question}}?</h4>
                    @foreach ($question->answers as $answer)
                        <p class="order-subject2">{{ $answer->answer }}</p>
                    @endforeach
                </div>
                <div class="col-md-6"></div>
            </div>    
        @endforeach
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-4"></div>
            <div class="col-md-2">
            <h4 class="total-price">Total&nbsp;&nbsp;&nbsp;Rs.{{ $order->amount }}</h4>
            </div>
        </div>
        
        
    </div>
</section>


@endsection

