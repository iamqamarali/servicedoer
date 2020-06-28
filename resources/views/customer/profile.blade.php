@extends('layouts.app')

@section('content')
<section id="review">
  <div class="container">
    @include('partials.messages')
      <div class="row">
          <div class="col-md-4">
              <div class="reviewer-div text-center">
                  <img src="{{ $customer->profile_image }}" width="130" style="margin-top:15px" alt="reviewer">
                  <h3>{{ $customer->name }}</h3>
                  <p class="location1"><i class="fas fa-map-marker-alt alt2"></i> {{ $customer->address  }}   {{ $customer->city->name }}</p>   
              </div>
              <div class="reviewer-info info2">
                    <p class="bio-para">Bio<br/><span class="bio">{{ $customer->bio }}</span></p>
              </div>
          </div>
          {{-- <div class="col-md-8">
              <h3>Reviews </h3>
              @foreach ($reviews as $review)
                <p class="customer-para">{{ $review->review }}</p>
                <div class="row">
                  <div class="col-md-4">
                  <p class="rating">{{ $review->created_at->diffForHumans() }}</p>
                  </div>
                  <div class="col-md-2"></div>
                  <div class="col-md-6">
                    <p class="rating-info">-{{$review->customer->name}} &nbsp; {{$review->rating }} <i class="fas fa-star star2"></i><i class="fas fa-star star2"></i><i class="fas fa-star star2"></i><i class="fas fa-star star2"></i><i class="fas fa-star star2"></i></p>
                  </div>
                </div>
              @endforeach   
          </div> --}}

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