@extends('layouts.app')

@section('content')
<section id="review" class="customer-profile-page">
  <div class="container">
    @include('partials.messages')
      <div class="row">
          <div class="col-md-4">
              <div class="reviewer-div text-center">
                  <div class="profile-pic" style="background-image:url({{ $customer->profile_image }})" ></div>
                  <h3>{{ $customer->name }}</h3>
                  <p class="location1"><i class="fas fa-map-marker-alt alt2"></i> {{ $customer->address  }}   {{ $customer->city->name }}</p>   

                  <div style="margin:10px 0">
                    <b>Orders Completed : </b>
                    {{ $orders->count() }}                      
                  </div>
                  <div style="margin:10px 0">
                    <b>Money Spent : </b>
                    {{ $orders->pluck('amount')->sum() }}                      
                  </div>

              </div>
              <div class="reviewer-info info2">
                    <p class="bio-para">Bio<br/><span class="bio">{{ $customer->bio }}</span></p>
              </div>
              
          </div>
      </div>
  </div>
</section>



<div class="modal fade" id="service-questions-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="trainer-box"> 
            <div class="row let-us">
                <h3>Let us help you find a better service provider</h3>
            </div>
            <div class="row">
                  <form action="#" id="main-form">
                        <p class="gender question">What sex are you looking for?</p>


                        <div class="answers">
            
                        </div>            
                  </form>
                  <div class="text-center"><input type="button" class="continue continue-btn continue-button" value="Continue"></div>
              </div>
          </div>   
      </div>
      <div class="modal-footer">
      </div>
  </div>
  </div>
</div>



@endsection

@push('scripts')

@endpush