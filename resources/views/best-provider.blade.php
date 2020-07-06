@extends('layouts.app')

@section('content')    
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 profile-box">
      @include('partials.messages')
      @if ($provider)
              <div id="trainer">
                  <h2>{{ $provider->service->name }} for you</h2>  
                  <br>
              </div>
              <br>
              <div class="trainers single-provider">
                  <div class="row">
                  <div class="col-md-4">
                      <div class="provider-dp" style="background-image:url({{ $provider->profile_image }})" ></div>
                  </div>
                  <div class="col-md-7">
                      <h2>{{ $provider->name }}</h2>
                      @if ($provider->serviceProviderReviews->count())
                          <p>{{ $provider->rating }}
                              <span class="stars">
                                  @for ($i = 0; $i < $provider->serviceProviderReviews[0]->rating; $i++)
                                      <i class="fas fa-star"></i>
                                  @endfor
                              </span>
                              ({{ $provider->serviceProviderReviews->count() }} reviews)
                          </p>
                      @endif

                      <p><i class="fas fa-map-marker-alt"></i> {{ $provider->address  }}   {{ $provider->city->name }}</p>
                      @if ($provider->serviceProviderReviews->count())
                          <p class="testimonial testimonial2">{{ $provider->serviceProviderReviews[0]->review }}</p>
                          <p class="reviewer">{{ $provider->serviceProviderReviews[0]->customer->name }}</p>
                      @endif
                      <div class="clearfix">
                          <a href="/profile/{{ $provider->id }}" class="action-btn2 view-profile-btn">View Profile</a>
                      </div>   
                  </div>
                  <div class="col-md-1"></div>  
                  </div>
              </div>
        
            <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-10">           
                <h2 >Location</h2>
                <br>
                <div id="map" ></div>
              </div>
              <div class="col-md-1"></div>
            </div>
        </div>
     @else
        <div class="alert alert-danger">Sorry we were unable to find a service provider for your requirements</div>
      @endif
    <div class="col-md-3"></div>
</div>
@endsection
@push('scripts')
<script>
  var geocoder;
  var map;
  var address;
  @if ($provider)
    address = "{{ $provider->address . ' ' . $provider->city->name . ' pakistan' }}";    
  @endif

  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,
      center: {lat: -34.397, lng: 150.644}
    });
    geocoder = new google.maps.Geocoder();
    codeAddress(geocoder, map);
  }

  function codeAddress(geocoder, map) {
    geocoder.geocode({'address': address}, function(results, status) {
      if (status === 'OK') {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
        });
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  }
</script>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3mZuUggAGBx7IQ-GV1eswAqrqV7gVUKg&callback=initMap">
</script>
@endpush