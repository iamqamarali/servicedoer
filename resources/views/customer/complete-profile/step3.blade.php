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
                            <a href="" index="{{ $loop->index }}" class="{{ $loop->index == 1 ? 'price-button2': 'price-button'}} subscribe-to-package-button">Get Started</a>
                        </div>
                    </div>
                    
                 @endforeach

                 <div class="col-md-1"></div>
             </div>
         </div>
     </section>

    
     <div class="modal fade" id="subscription-payment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
              <div class="modal-inner-box">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>


                  <h3 class="">Please enter your credit card information</h3>
                  
                  <div style="margin: 30px 0 30px ">
                    <b>Subscription price :</b> <span class="package-price" style="font-weight:500; font-size: 1.5em; float: right" ></span>
                  </div>
        

                  <form action="/subscription/subscribe" method="post" id="payment-form">
                    @csrf
                    <div class="form-row">
                      <label for="card-element" style="margin-bottom: 10px">
                        Credit or debit card
                      </label>
                      <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                      </div>
                  
                      <!-- Used to display Element errors. -->
                    <div id="card-errors" role="alert"></div>
                    </div>
        
                    <br>
                    <br>
                    <input type="hidden" hidden  id="package-input" name="package" value="" >
                  
                    <button class="continue ">Submit Payment</button>
                  </form>
                



              </div>                
            </div>
        </div>
      </div>
  </div>
@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
  <script>
        var packages =  {!! $packages !!}
        $('.subscribe-to-package-button').click(function(e){
            e.preventDefault()
            var index = $(this).attr('index')
            var package = packages[index]
            $modal = $('#subscription-payment-modal')
            $modal.modal('show')
            $modal.find('#package-input').val(package._id)
            $modal.find('.package-price').html(package.price + 'Rs')
        });

        var stripe = Stripe('pk_test_atqdXKW6mSL2Ad9VbirCWRfF00JCyqSrz8');
          var elements = stripe.elements();

          var style = {
              base: {
                  // Add your base input styles here. For example:
                  fontSize: '16px',
                  color: '#32325d',
              },
          };

          // Create an instance of the card Element.
          var card = elements.create('card', {style: style});

          // Add an instance of the card Element into the `card-element` <div>.
          card.mount('#card-element');

          // Create a token or display an error when the form is submitted.
      var form = document.getElementById('payment-form');
      form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
          if (result.error) {
            // Inform the customer that there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
          } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
          }
        });
      });

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

  </script>
@endpush