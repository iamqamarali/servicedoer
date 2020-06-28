@extends('layouts.app')

@section('content')    
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 profile-box">
      <div id="trainer">
        <h2>Trainer for you</h2>  
      </div>
      <div class="row main-profile">
               <div class="col-md-4">
                   <img src="{{ $provider->profile_image }}" alt="trainer" class="profile-img img2">
               </div>
               <div class="col-md-7">
                   <h2>{{ $provider->name }}</h2>
                   <p>{{ $provider->rating }}<span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span>(19 reviews)</p>
                  <p><i class="fas fa-map-marker-alt"></i>{{ $provider->address }} {{ $provider->city->name }}, Pakistan</p>
                  @if ($review = $provider->serviceProviderReviews()->latest()->first())
                    <p class="testimonial">"{{ $review->review }}"</p>
                    <p class="reviewer">-{{ $review->customer->name }}</p>
                    <p class="read-para"><a href="{{ route('service-provider.profile', $provider->id) }}" class="read-btn">Read more</a></p>                    
                  @endif
               </div>
               <div class="col-md-1"></div>
      </div>   
      <div class="row">
          <div class="col-md-8"></div>
          <div class="col-md-4 text-right button-col">
                <a href="{{ route('service-provider.profile', $provider->id) }}" class="action-btn2 btn-2">View Profile</a>
          </div>
      </div>    
      <div class="row">
       <h2 class="location-heading">Location</h2>
      </div>
      <div class="row">
         <div class="col-md-1"></div>
         <div class="col-md-10">
           
          <div id="map"></div>
        </div>
         <div class="col-md-1"></div>
      </div>
   </div>
   <div class="col-md-2"></div>
</div>
@endsection

@push('scripts')
<script>
  var geocoder;
  var map;
  var address = "new york city";
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
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
  src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
</script>
@endpush