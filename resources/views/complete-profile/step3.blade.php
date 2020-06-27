@extends('layouts.app')

@section('content')
<section id="pricing-heading-sec">
        <div class="container">  
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <h3 class="pricing-heading">Our Pricing &amp; Plans </h3>
              <p class="pricing-para">Our pricing is fair and transparent, so our costs are clear from the Start.
                We do our best to give you an<br/> estimate for every stage as your case develops so that you are not
                surprised<br/> by hidden fees.
              </p>
            </div>
            <div class="col-md-1"></div>  
          </div> 
        </div>    

     </section>
     <section id="pricing">
         <div class="container">
             <div class="row price-row">
                 <div class="col-md-2"></div>
                 @foreach ($packages as $package)
                    <div class="col-md-3">
                        <div class="{{ $loop->index == 1 ? 'pricebox2': 'pricebox1'  }} text-center">
                            <h4>{{ $package->name }}</h4>
                            <p class="{{ $loop->index == 1 ? 'price-text2': 'price-text'  }}">Rs<span class="{{ $loop->index == 1 ? 'amount-number2': 'amount-number'  }}">{{ $package->price }}/mo</span></p>
                            <ul class="{{ $loop->index == 1 ? 'price-list2': 'price-list'  }}">
                                <li>Finance Analyzing</li>
                                <li>{{ $package->time_period }} subscription</li>
                                <li>24 Hour Support</li>
                                <li>{{ $package->connects }} Connects in a month</li>
                                <li>{{ $package->connects }} jobs can be availed</li>
                            </ul>
                            <p class="{{ $loop->index == 1 ? 'trial2': 'trial'  }}">{{ $package->trial_days }} days free trial</p>
                            <a href="/subscribe/{{ $package->id }}" class="{{ $loop->index == 1 ? 'price-button2': 'price-button'  }}">Get Started</a>
                        </div>
                    </div>
                    
                 @endforeach

                 <div class="col-md-1"></div>
             </div>
         </div>

     </section>
@endsection