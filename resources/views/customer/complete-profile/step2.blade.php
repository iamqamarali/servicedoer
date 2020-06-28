@extends('layouts.app')

@section('content')
<section id="steps">
    <div class="container">
        <div class="row">
           <div class="col-md-1"></div>   
           <div class="col-md-10 text-center">  
               <ul>
                 <li class="steps">1</li>
                 <li class="steps step2">2</li>
              </ul> 
           </div>   
           <div class="col-md-1"></div>   

        </div>
    </div>
</section>
<section id="picture">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 text-center">
                <form action="/customer/complete-profile/step2" method="post" class="picture-form complete-profile-form" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="profile_pic" class="custom-file-input profile-pic-file-input" accept="image/x-png,image/gif,image/jpeg">
                    <div class="profile-pic-image-name"></div>
                    <p class="profile">{{ auth()->user()->name }}</p>

                    <br>
                    @include('partials.errors')
                    <br>

                    <div class="row location-info-row">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            
                              <div class="form-group">
                                <label for="city" class="location-info">City</label>
                                <select class="form-control form-input city-select" name="city">
                                    <option value="">City</option>
                                    @foreach ($cities as $city)                               
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address" class="location-info">Address</label>
                                <input type="text" name="address" class="form-control form-input">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="phone" class="location-info">Phone</label>
                                <input type="text" name="phone" class="form-control form-input phone-input" placeholder="">
                            </div>
                        </div>
                    </div>
                  <div class="row text-area">
                      <div class="col-md-1"></div>
                      <div class="col-md-10">
                          <div class="form-group">
                              <label for="biography" class="location-info">Tell us about yourself</label>
                              <textarea name="bio" class="form-control biography bio-input"  cols="30" rows="2"></textarea>
                          </div>
                      </div>
                      <div class="col-md-1"></div>

                  </div>
                  <div class="row">
                      <div class="col-md-4"></div>
                      <div class="col-md-4">
                          <button type="submit" class="continue2 ">Continue</button>
                      </div>
                      <div class="col-md-4"></div>
                  </div>  
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</section>
>

@endsection

@push('scripts')
<script>

   
</script>
@endpush