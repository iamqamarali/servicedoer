@extends('layouts.app')

@section('content')

<section id="orders">
    <div class="container">
        <div class="row">
            <h3 class="active-order">Order Details</h3>
        </div>
        <div class="row active-row active-row2">
            <div class="col-md-5 customer-profile2">
                <h4 class="order-id">Order #{{ $order->id }}</h4>
                <p>Buyer:&nbsp; {{ $order->customer->name }}&nbsp;&nbsp;&nbsp;<a href="{{ route('customer.profile', $order->customer_id) }}" class="order-profile">View Profile</a></p>
                   <p class="order-location"><i class="fas fa-map-marker-alt map-sign map-sign2"></i> {{ $order->customer->address }}  {{ $order->customer->city->name }},Pakistan</p>
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
            <div class="col-md-2 text-center order-price">Rs.{{ $order->amount }}</div>
        </div>

        <div class="text-center">
            @if ($order->status == 'Cancelled')
                <div class="project-cancellation-reason">
                    <h4  >Project Cancellation Reason</h4>
                    <p>{{ $order->cancellation_reason }}</p>
                </div>
            @endif
        </div>

        <hr class="order-border"/>

        <div class="row order-subjects">
            <div class="col-md-6">
                <h3><b>Project Description</b></h3>
                <br>
            </div>    
        </div>    

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